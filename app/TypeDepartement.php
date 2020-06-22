<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TypeDepartement extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Type Departement';

    public static $view_folder = 'typedepartements';
    public static $view_fields = 'typedepartements.fields';
    public static $view_table_values = 'typedepartements.table_values';
    public static $view_table_headers = 'typedepartements.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'typedepartement';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'type mouvement';
    public static $title_plu = 'types mouvement';

    public static $route_index = 'TypeDepartementController@index';
    public static $route_create = 'TypeDepartementController@create';
    public static $route_store = 'TypeDepartementController@store';
    public static $route_show = 'TypeDepartementController@show';
    public static $route_edit = 'TypeDepartementController@edit';
    public static $route_update = 'TypeDepartementController@update';
    public static $route_destroy = 'TypeDepartementController@destroy';

    public static $breadcrumb_index = 'typedepartements';
    public static $breadcrumb_create = 'typedepartements.create';
    public static $breadcrumb_show = 'typedepartements.show';
    public static $breadcrumb_edit = 'typedepartements.edit';

    public static $denomination_field = 'libelle';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
        'intitule' => ['required','unique:type_departements,intitule,NULL,id,deleted_at,NULL'],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
        'intitule' => ['required','unique:type_departements,intitule,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [
        'intitule.required' => 'Prière de renseigner l Intitule',
      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'Type Departements',
    //     'modeltype' => 'du type de departement',
    //     'index_route' => 'TypeDepartementController@index',
    //     'create_route' => 'TypeDepartementController@create',
    //     'store_route' => 'TypeDepartementController@store',
    //     'show_route' => 'TypeDepartementController@show',
    //     'edit_route' => 'TypeDepartementController@edit',
    //     'update_route' => 'TypeDepartementController@update',
    //     'destroy_route' => 'TypeDepartementController@destroy',
    //     'table_values' => 'typedepartements.table_values',
    //     'table_headers' => 'typedepartements.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'typedepartements',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'breadcrumb_title' => 'typedepartements.create',
    //     'breadcrumb_param' => '',
    //     'model_fields' => 'typedepartements.fields',
    //     'morecontrols' => [],
    //     'moreforms' => [],
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'typedepartements.edit',
    //     'model_fields' => 'typedepartements.fields',
    //     'morecontrols' => [],
    //     'moreforms' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'typedepartements.show',
    //   ],
    //   'field_label' => 'intitule',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
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
     * Renvoie le Statut du TypeDepartement.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    public function departements() {
        return $this->hasMany('App\Departement', 'type_departement_id');
    }
}
