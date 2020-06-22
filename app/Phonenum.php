<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class Phonenum extends AppBaseModel
{
   protected $guarded = [];
   use SoftDeletes;

   public static $model_name = 'Numero Phone';

   public function getDenominationAttribute() {
       return $this->numero;
   }

   public function scopeSearch($query, $q) {
     if ($q == null) return $query;

     $statuts = Statut::search($q)->get()->pluck('id')->toArray();

     return $query
       ->where('numero', 'LIKE', "%{$q}%")
       ->orWhereIn('statut_id', $statuts)
       ;
   }

   /**
    * Renvoie le Statut du Phonenum.
    */
   public function statut() {
      return $this->belongsTo('App\Statut');
   }

   /**
    * Renvoie les Employe qui ont ce numéro de téléphone (Phonenum).
    */
   public function employes() {
      return $this->belongsToMany('App\Employe');
   }

   /**
    * Renvoie les Fournisseur qui ont ce numéro de téléphone (Phonenum).
    */
    public function fournisseurs() {
       return $this->belongsToMany('App\Fournisseur');
    }
}
