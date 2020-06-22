<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Statut;

use Illuminate\Database\Eloquent\SoftDeletes;


class TypeAffectation extends AppBaseModel
{
    use SoftDeletes;
    protected $guarded = [];

    public static $model_name = 'Type Affectation';

    public static $view_folder = 'typeaffectations';
    public static $view_fields = 'typeaffectations.fields';
    public static $view_table_values = 'typeaffectations.table_values';
    public static $view_table_headers = 'typeaffectations.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'typeaffectation';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'type affectation';
    public static $title_plu = 'types affectation';

    public static $route_index = 'TypeAffectationController@index';
    public static $route_create = 'TypeAffectationController@create';
    public static $route_store = 'TypeAffectationController@store';
    public static $route_show = 'TypeAffectationController@show';
    public static $route_edit = 'TypeAffectationController@edit';
    public static $route_update = 'TypeAffectationController@update';
    public static $route_destroy = 'TypeAffectationController@destroy';

    public static $breadcrumb_index = 'typeaffectations';
    public static $breadcrumb_create = 'typeaffectations.create';
    public static $breadcrumb_show = 'typeaffectations.show';
    public static $breadcrumb_edit = 'typeaffectations.edit';

    public static $denomination_field = 'libelle';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
          'tags' => ['required','array','max:1'],
      ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
        'libelle' => ['required','unique:type_affectations,libelle,NULL,id,deleted_at,NULL',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
        'libelle' => ['required','unique:type_affectations,libelle,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [
        'libelle.required' => 'Prière de renseigner le Libellé',
      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'types affectation',
    //     'modeltype' => 'du type d’affectation',
    //     'index_route' => 'TypeAffectationController@index',
    //     'create_route' => 'TypeAffectationController@create',
    //     'store_route' => 'TypeAffectationController@store',
    //     'show_route' => 'TypeAffectationController@show',
    //     'edit_route' => 'TypeAffectationController@edit',
    //     'update_route' => 'TypeAffectationController@update',
    //     'destroy_route' => 'TypeAffectationController@destroy',
    //     'table_values' => 'typeaffectations.table_values',
    //     'table_headers' => 'typeaffectations.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'typeaffectations',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'typeaffectations.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'typeaffectations.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'typeaffectations.edit',
    //     'model_fields' => 'typeaffectations.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'typeaffectations.show',
    //   ],
    //   'field_label' => 'libelle',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('libelle', 'LIKE', "%{$q}%")
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

    public static function scopeForClass($query, $class) {
      $active_statut = Statut::actif()->first();

      return $query
        ->where('object_class_name', $class)
        ->where('statut_id', $active_statut->id);
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

    public function statut() {
        return $this->belongsTo('App\Statut');
    }
    /**
     * Retourne tous les TypeArticle qui ont ce Statut.
     */
    public function affectations()
    {
        return $this->hasMany('App\Affectation');
    }
}
