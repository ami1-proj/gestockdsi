<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agence extends Model
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
            $fullpath = $this->zone->intitule;
        } else {
            $fullpath = $this->zone->intitule . " / " . $this->intitule;
        }

        return "{$fullpath}";
    }

    public function getAlternativePathAttribute()
    {
        if ($this->intitule == " ") {
            $alternativepath = $this->zone->intitule;
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
     * Renvoie le Statut de Zone.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie l'employe responsable de la Zone.
     */
    public function employeResponsable() {
        return $this->belongsTo('App\Employe', 'employe_responsable_id');
    }

    /**
     * Renvoie la Zone du Service.
     */
    public function zone() {
        return $this->belongsTo('App\Zone');
    }

    /**
     * Retourne tous les Service de cette Zone.
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
      $zones = Zone::search($q)->get()->pluck('id')->toArray();


      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $status)
        ->orWhereIn('zone_id', $zones);


    }
}
