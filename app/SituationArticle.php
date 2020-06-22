<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SituationArticle extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    /**
     * Renvoie le Statut de la SituationArticle.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie tous les Articles ayant cette situation (SituationArticle).
     */
    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function scopeDefault($query, $exclude = [] ) {

      return $query->where('default', true)->whereNotIn('id', $exclude);
      
    }

    public function scopeTagged($tag){
      return $query
        ->where('tags', 'LIKE', "%{$tags}%");
    }
}
