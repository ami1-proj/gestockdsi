<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class EtatCommande extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public static $model_name = 'Etat Commande';

    public static $view_folder = 'etatcommandes';
    public static $view_fields = 'etatcommandes.fields';
    public static $view_table_values = 'etatcommandes.table_values';
    public static $view_table_headers = 'etatcommandes.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'etatcommande';
    public static $unique_fields = [];

    public static $det_sing = 'l’';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l’';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'etat commande';
    public static $title_plu = 'etats commande';

    public static $route_index = 'EtatCommandeController@index';
    public static $route_create = 'EtatCommandeController@create';
    public static $route_store = 'EtatCommandeController@store';
    public static $route_show = 'EtatCommandeController@show';
    public static $route_edit = 'EtatCommandeController@edit';
    public static $route_update = 'EtatCommandeController@update';
    public static $route_destroy = 'EtatCommandeController@destroy';

    public static $breadcrumb_index = 'etatcommandes';
    public static $breadcrumb_create = 'etatcommandes.create';
    public static $breadcrumb_show = 'etatcommandes.show';
    public static $breadcrumb_edit = 'etatcommandes.edit';

    public static $denomination_field = 'libelle';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'libelle' => ['required','unique:etat_commandes,libelle,NULL,id,deleted_at,NULL',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'libelle' => ['required','unique:etat_commandes,libelle,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'etats commande',
    //     'modeltype' => 'de l’Etat de commande',
    //     'index_route' => 'EtatCommandeController@index',
    //     'create_route' => 'EtatCommandeController@create',
    //     'store_route' => 'EtatCommandeController@store',
    //     'show_route' => 'EtatCommandeController@show',
    //     'edit_route' => 'EtatCommandeController@edit',
    //     'update_route' => 'EtatCommandeController@update',
    //     'destroy_route' => 'EtatCommandeController@destroy',
    //     'table_values' => 'etatcommandes.table_values',
    //     'table_headers' => 'etatcommandes.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'etatcommandes',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'etatcommandes.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'etatcommandes.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'etatcommandes.edit',
    //     'model_fields' => 'etatcommandes.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'etatcommandes.show',
    //   ],
    //   'field_label' => 'libelle',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('libelle', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ;
    }

    /**
     * Filtre d élément par défaut
     * @param  var $query   La requete
     * @param  array  $exclude liste d ids a exclure le cas echeant
     * @return var          La nouvelle requete
     */
    public function scopeDefault($query, $exclude = []) {
      return $query
        ->where('is_default', true)->whereNotIn('id', $exclude);
    }

    /**
     * Filtre de recherche d élément(s) contenant un tag donné
     * @param  var $query La requete
     * @param  string $tag   Le tag recherché
     * @return var        La nouvelle requete
     */
    public function scopeTagged($query, $tag) {
      return $query
        ->where('tags', 'LIKE', "%{$tag}%");
    }

    /**
     * Renvoie le Statut de EtatCommande.
     */
     public function statut() {
       return $this->belongsTo('App\Statut');
     }

     /**
      * Retourne toutes les Commande qui ont cet Etat (EtatCommande).
      */
     public function commandes()
     {
         return $this->hasMany('App\Commande', 'etat_commande_id');
     }
}
