<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    /**
    * Get the serivice's full path.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getFullPathAttribute()
    {
        if ($this->intitule == " ") {
            $fullpath = $this->division->fullpath;
        } else {
            $fullpath = $this->division->fullpath . " / " . $this->intitule;
        }

        return "{$fullpath}";
    }

    public function getAlternativePathAttribute()
    {
        if ($this->intitule == " ") {
            $alternativepath = $this->division->alternativepath;
        } else {
            $alternativepath = $this->intitule;
        }

        return "{$alternativepath}";
    }

    /**
    * Get designation complete.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getDesignationCompleteAttribute()
    {
        return "{$this->full_path}";
    }

    /**
     * Renvoie le Statut du Service.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie l'employe responsable du Service.
     */
    public function employeResponsable() {
        return $this->belongsTo('App\Employe', 'employe_responsable_id');
    }

    /**
     * Renvoie la Division du Service.
     */
    public function division() {
        return $this->belongsTo('App\Division');
    }

    public function affectations() {
        return $this->hasMany('App\Affectation')
          ->whereNull('date_fin');
    }


     public function scopeSearch($query, $q) {
      if ($q == null) return $query;
      $status = Statut::search($q)->get()->pluck('id')->toArray();
      $divisions = Division::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $status)
        ->orWhereIn('division_id', $divisions)
        ;
    }
}
