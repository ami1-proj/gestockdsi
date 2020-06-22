<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Statut;

trait DefaultTrait {

  public function unsetDefault($curr_model) {
    if (Schema::hasColumn($curr_model->getTable(), 'is_default')) {
      $olddefault = $this->getDefault($curr_model, [$curr_model->id]);
      //dd($curr_model, $olddefault);
      if ($curr_model->is_default == true) {
        if (is_null($olddefault)) {
          //dd('nothing to do', $olddefault);
        } else {
          $olddefault = $this->setDefault($curr_model->getTable(), $olddefault->id, 0);
        }

        // If this model is just deleted,
        // We set the min id as default
        if ($this->isDeleted($curr_model)) {
          $min_id = DB::table($curr_model->getTable())->min('id');
          $this->setDefault($curr_model->getTable(), $min_id, 1);
        }
      }
    }
  }

  private function getDefault($curr_model, $exclude = []) {
    return DB::table($curr_model->getTable())->where('is_default', 1)->whereNotIn('id', $exclude)->first();
  }

  private function setDefault($model_table, $model_id, $default_value) {
    return DB::table($model_table)
        ->where('id',$model_id)
        ->update(['is_default' => $default_value]);
  }

  public function isDeleted($curr_model) : bool {
    
    $curr_model_fromtable = DB::table($curr_model->getTable())->where('id', $curr_model->id)->first();
    if (is_null($curr_model_fromtable)){
      $is_deleted = true;
    } else {
      if (Schema::hasColumn($curr_model->getTable(), 'deleted_at')) {
        $is_deleted = (!(is_null($curr_model->deleted_at)));
      } else {
        $is_deleted = false;
      }
    }

    return $is_deleted;
  }

  public function setDefaultFromRequestInput($formInput){

      $formInput['is_default'] = array_key_exists('is_default', $formInput);

      return $formInput;
  }

  /**
   * Initialise et retourne l objet vide d un modele
   * @param  object $newobject objet vide
   * @return [type]            le nouvel objet initialise
   */
  public function getDefaultObject($newobject) {
      $newobject->statut_id = Statut::default()->first()->id;
      return $newobject;
  }
}
