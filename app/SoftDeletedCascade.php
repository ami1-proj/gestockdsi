<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftDeletedCascade extends Model
{
    protected $guarded = [];
    protected $fillable = ['recycle_bin_id', 'object_class_name', 'object_model_name', 'object_ids', 'foreign_key_field'];

    public function recyclebin() {
      return $this->belongsTo('App\RecycleBin', 'recycle_bin_id');
    }
}
