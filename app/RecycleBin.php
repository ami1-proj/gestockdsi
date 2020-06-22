<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PermissionTrait;
use App\Traits\AppBaseTrait;

class RecycleBin extends Model
{
    use PermissionTrait;
    use AppBaseTrait;

    protected $guarded = [];
    protected $table = 'recycle_bin';

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      return $query
        ->where('object_denomination', 'LIKE', "%{$q}%")
        ->orWhere('object_model_name', 'LIKE', "%{$q}%")
        ;
    }

    /**
     * Get the comments for the blog post.
     */
    public function softcascades()
    {
        return $this->hasMany('App\SoftDeletedCascade', 'recycle_bin_id');
    }

    public function restoreModel() {
      if ($this->is_soft_deleted) {
        $model = $this->object_class_name::onlyTrashed()->find($this->object_id);
        if (!(is_null($model))) {
          $model->restore();
        }
      }
    }

    public function deleteModel() {
      if ($this->is_soft_deleted) {
        $model = $this->object_class_name::onlyTrashed()->find($this->object_id);
        if (!(is_null($model))) {
          $model->forceDelete();
        }
      }
    }
}
