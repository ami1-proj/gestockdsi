<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
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
            $fullpath = $this->direction->intitule;
        } else {
            $fullpath = $this->direction->intitule . " / " . $this->intitule;
        }

        return "{$fullpath}";
    }

    public function getAlternativePathAttribute()
    {
        if ($this->intitule == " ") {
            $alternativepath = $this->direction->intitule;
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
     * Renvoie le Statut de Division.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie l'employe responsable de la Division.
     */
    public function employeResponsable() {
        return $this->belongsTo('App\Employe', 'employe_responsable_id');
    }

    /**
     * Renvoie la Direction du Service.
     */
    public function direction() {
        return $this->belongsTo('App\Direction');
    }

    /**
     * Retourne tous les Service de cette Division.
     */
    public function services() {
        return $this->hasMany('App\Service');
    }

    public function affectations() {
        return $this->hasMany('App\Affectation')
          ->whereNull('date_fin');
    }

     public function scopeSearch($query, $q) {
      if ($q == null) return $query;
      $status = Statut::search($q)->get()->pluck('id')->toArray();
      $directions = Direction::search($q)->get()->pluck('id')->toArray();


      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $status)
        ->orWhereIn('direction_id', $directions);


    }
}
