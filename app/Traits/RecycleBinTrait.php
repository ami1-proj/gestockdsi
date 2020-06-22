<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

use App\RecycleBin;
use App\SoftDeletedCascade;  

trait RecycleBinTrait {

  abstract public function getDenominationAttribute();

  public function addToRecycleBin() {

    $class_name = get_called_class();
    $recyclebin = RecycleBin::where('object_class_name', $class_name)->where('object_id', $this->id)->first();

    if (is_null($recyclebin)) {

        $trashed = new RecycleBin();

        $trashed->object_class_name = $class_name;

        $trashed->object_id = $this->id;
        $trashed->user_id = Auth::user()->id;

        $trashed->object_denomination = $this->denomination;
        $trashed->object_model_name = $trashed->object_class_name::$model_name;
        $trashed->is_soft_deleted = $this->isSoftDeleted();

        $trashed->save();

        //$sub_children = $this->subChildrenRelations();
        $this->relationships();
        $sub_children = $this->subChildrenRelations();

        if ($trashed->is_soft_deleted) {
          $this->saveSoftCascades($this, $trashed->id, $sub_children);
          $this->dissociateSubChildren($sub_children);
        }
        //dd("addToRecycleBin", $this, $trashed);
    }
  }

  private function getClassArray($model) {
    $class_array[0] = class_basename($model);
    $class_array[1] = "App\\" . class_basename($model);

    return $class_array;
  }

  private function isSoftDeleted() {
    $model_from_table = DB::table($this->getTable())->where('id', $this->id)->first();
    $is_soft_deleted = (!(is_null($model_from_table)));

    return $is_soft_deleted;
  }

  //
  public function dissociateSubChildren($sub_children) {

    
    foreach ($sub_children as $subfunc_name => $relation_infos_data) {
      foreach ($relation_infos_data['sub_objects'] as $sub_child) {
        $sub_child->{$relation_infos_data['foreignKey']} = null;
        $sub_child->save();
      }
    }

  }

  public function saveSoftCascades($model, $recyclebin_id, $sub_children) {

      
    foreach ($sub_children as $subfunc_name => $relation_infos_data) {
      if ($relation_infos_data['sub_objects']->count() > 0) {
        // save cascade
        $cascade = SoftDeletedCascade::create([
          'recycle_bin_id' => $recyclebin_id,
          'object_class_name' => $relation_infos_data['model'],
          'object_model_name' => $relation_infos_data['model']::$model_name,
          'object_ids' => implode(',', $relation_infos_data['sub_objects']->modelKeys()),
          'foreign_key_field' => $relation_infos_data['foreignKey'],
        ]);
      }
    }

  }

  public function associateSubChildren($sub_children) {

    foreach ($sub_children[2] as $sub_child_id) {
      $sub_child = $sub_children[0]::find($sub_child_id);
      if (!(is_null($sub_child)) && (is_null($sub_child->{$sub_children[1]}))) {
        $sub_child->{$sub_children[1]} = $this->id;
        $sub_child->save();
      }
    }

  }

  public function restoreFromRecycleBin() {
    $class_name = get_called_class();
    $recyclebin = RecycleBin::where('object_class_name', $class_name)->where('object_id', $this->id)->get();
    if ($recyclebin->is_soft_deleted) {
      $this->restore();
    }
  }

  public function removeFromRecycleBin($from_restore = true) {
    $class_name = get_called_class();
    $recyclebin = RecycleBin::where('object_class_name', $class_name)->where('object_id', $this->id)->first();

    foreach ($recyclebin->softcascades as $softcascade) {
      if ($from_restore) {
        $sub_children = [$softcascade->object_class_name, $softcascade->foreign_key_field, explode(',', $softcascade->object_ids)];
        $this->associateSubChildren($sub_children);
      }
      $softcascade->delete();
    }

    $recyclebin->delete();
    //dd("removeFromRecycleBin", $this, $class_name, $recyclebin);

  }

}
