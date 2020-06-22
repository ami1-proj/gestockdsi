<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class Adresseemail extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public function getDenominationAttribute() {
        return $this->email;
    }

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('email', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ;
    }

    /**
     * Renvoie le Statut de l'Adresseemail.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie les Employe qui ont cette e-mail (Adresseemail).
     */
    public function employes() {
       return $this->belongsToMany('App\Employe');
    }

    /**
     * Renvoie les Fournisseur qui ont cette e-mail (Adresseemail).
     */
     public function fournisseurs() {
        return $this->belongsToMany('App\Fournisseur');
     }
}
