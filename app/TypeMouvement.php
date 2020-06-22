<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;

class TypeMouvement extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Type Mouvement';

    public static $view_folder = 'typemouvements';
    public static $view_fields = 'typemouvements.fields';
    public static $view_table_values = 'typemouvements.table_values';
    public static $view_table_headers = 'typemouvements.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'typemouvement';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'type mouvement';
    public static $title_plu = 'types mouvement';

    public static $route_index = 'TypeMouvementController@index';
    public static $route_create = 'TypeMouvementController@create';
    public static $route_store = 'TypeMouvementController@store';
    public static $route_show = 'TypeMouvementController@show';
    public static $route_edit = 'TypeMouvementController@edit';
    public static $route_update = 'TypeMouvementController@update';
    public static $route_destroy = 'TypeMouvementController@destroy';

    public static $breadcrumb_index = 'typemouvements';
    public static $breadcrumb_create = 'typemouvements.create';
    public static $breadcrumb_show = 'typemouvements.show';
    public static $breadcrumb_edit = 'typemouvements.edit';

    public static $denomination_field = 'libelle';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
        'libelle' => ['required','unique:type_mouvements,libelle,NULL,id,deleted_at,NULL',]
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
        'libelle' => ['required','unique:type_mouvements,libelle,'.$model->id .',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [
        'libelle.required' => 'Prière de renseigner le Libellé',
      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'types mouvement',
    //     'modeltype' => 'du type de mouvement',
    //     'index_route' => 'TypeMouvementController@index',
    //     'create_route' => 'TypeMouvementController@create',
    //     'store_route' => 'TypeMouvementController@store',
    //     'show_route' => 'TypeMouvementController@show',
    //     'edit_route' => 'TypeMouvementController@edit',
    //     'update_route' => 'TypeMouvementController@update',
    //     'destroy_route' => 'TypeMouvementController@destroy',
    //     'table_values' => 'typemouvements.table_values',
    //     'table_headers' => 'typemouvements.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'typemouvements',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'typemouvements.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'typemouvements.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'typemouvements.edit',
    //     'model_fields' => 'typemouvements.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'typemouvements.show',
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
     * Filtre les TypeMouvement non tagés systeme
     * @param  var $query La requete
     * @return var        La nouvelle requete
     */
    public function scopeNonSystem($query) {
      return $query
        ->where('tags', 'NOT LIKE', "%Systeme%");
    }

    public function scopeCreation($query) {
      return $this->scopeTagged($query, 'Systeme,Creation');
    }

    public function scopeSuppression($query) {
      return $this->scopeTagged($query, 'Systeme,Suppression');
    }

    public function scopeModification($query) {
      return $this->scopeTagged($query, 'Modification');
    }

    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle', 'type_mouvement_id');
    }
}
