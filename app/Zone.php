<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    /**
    * Get designation complete.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getDesignationCompleteAttribute()
    {
        return "{$this->intitule}";
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
     * Retourne toutes les Division de cette Zone.
     */
    public function agences() {
        return $this->hasMany('App\Agence');
    }

    public function affectations() {
        return $this->hasMany('App\Affectation')
          ->whereNull('date_fin');
    }


     

public function scopeSearch($query, $q) {
      if ($q == null) return $query;
      $status = Statut::search($q)->get()->pluck('id')->toArray();
      //$employes = Employe::search($q)->get()->pluck('id')->toArray();


      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $status);
       // ->orWhereIn('employe_responsable_id', $employes)

    }

 }   

 