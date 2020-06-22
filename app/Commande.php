<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Commande extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Commande';

    public static $view_folder = 'commandes';
    public static $view_fields = 'commandes.fields';
    public static $view_table_values = 'commandes.table_values';
    public static $view_table_headers = 'commandes.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'commande';
    public static $unique_fields = [];

    public static $det_sing = 'la';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de la';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'commande';
    public static $title_plu = 'commandes';

    public static $route_index = 'CommandeController@index';
    public static $route_create = 'CommandeController@create';
    public static $route_store = 'CommandeController@store';
    public static $route_show = 'CommandeController@show';
    public static $route_edit = 'CommandeController@edit';
    public static $route_update = 'CommandeController@update';
    public static $route_destroy = 'CommandeController@destroy';

    public static $breadcrumb_index = 'commandes';
    public static $breadcrumb_create = 'commandes.create';
    public static $breadcrumb_show = 'commandes.show';
    public static $breadcrumb_edit = 'commandes.edit';

    public static $denomination_field = 'objet_commande';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
          'objet_commande' => ['required',],
      ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [

      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [

      ]);
    }
    public static function validationMessages() {
      return [

      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'commandes',
    //     'modeltype' => 'de la commande',
    //     'index_route' => 'CommandeController@index',
    //     'create_route' => 'CommandeController@create',
    //     'store_route' => 'CommandeController@store',
    //     'show_route' => 'CommandeController@show',
    //     'edit_route' => 'CommandeController@edit',
    //     'update_route' => 'CommandeController@update',
    //     'destroy_route' => 'CommandeController@destroy',
    //     'table_values' => 'commandes.table_values',
    //     'table_headers' => 'commandes.table_headers',
    //     'affectation_tag' => 'Commande',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'commandes',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'breadcrumb_title' => 'commandes.create',
    //     'breadcrumb_param' => '',
    //     'model_fields' => 'commandes.fields',
    //     'morecontrols' => [],
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'commandes.edit',
    //     'model_fields' => 'commandes.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'commandes.show',
    //   ],
    //   'field_label' => 'objet_commande',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $employes = Employe::search($q)->get()->pluck('id')->toArray();
      $etatcommandes = EtatCommande::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('objet_commande', 'LIKE', "%{$q}%")
        ->where('description_commande', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('employe_id', $employes)
        ->orWhereIn('etat_commande_id', $etatcommandes)
        ;
    }

    /**
     * Renvoie le Statut de la Commande.
     */
    public function statut() {
      return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le Etat (EtatCommande) de la Commande.
     */
    public function etatCommande() {
      return $this->belongsTo('App\EtatCommande');
    }

    /**
     * Renvoie l'Employe de la Commande.
     */
    public function employe() {
      return $this->belongsTo('App\Employe');
    }

    /**
     * Renvoie le(s) Article(s) de la Commande.
     */
     public function articles() {
        return $this->belongsToMany('App\Article')
          ->withPivot('statut_id')->withTimestamps();
     }
}
