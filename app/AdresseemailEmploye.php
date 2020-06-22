<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdresseemailEmploye extends Model
{
    protected $guarded = [];

    /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
    public $incrementing = true;

    /**
     * Renvoie le Statut de la relation Employe-Adresseemail.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }
}
