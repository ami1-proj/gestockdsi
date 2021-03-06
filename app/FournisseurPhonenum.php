<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FournisseurPhonenum extends Model
{
    protected $guarded = [];

    /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
    public $incrementing = true;

    /**
     * Renvoie le Statut de la relation Fournisseur-Phonenum.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }
}
