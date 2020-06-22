<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class StockEmplacement extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static $model_name = 'Emplacement en Stock';

    public static $view_folder = 'stockemplacements';
    public static $view_fields = 'stockemplacements.fields';
    public static $view_table_values = 'stockemplacements.table_values';
    public static $view_table_headers = 'stockemplacements.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'stockemplacement';
    public static $unique_fields = [];

    public static $det_sing = 'l ';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l ';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'emplacement en stock';
    public static $title_plu = 'emplacements en stock';

    public static $route_index = 'StockEmplacementController@index';
    public static $route_create = 'StockEmplacementController@create';
    public static $route_store = 'StockEmplacementController@store';
    public static $route_show = 'StockEmplacementController@show';
    public static $route_edit = 'StockEmplacementController@edit';
    public static $route_update = 'StockEmplacementController@update';
    public static $route_destroy = 'StockEmplacementController@destroy';

    public static $breadcrumb_index = 'stockemplacements';
    public static $breadcrumb_create = 'stockemplacements.create';
    public static $breadcrumb_show = 'stockemplacements.show';
    public static $breadcrumb_edit = 'stockemplacements.edit';

    public static $denomination_field = 'emplacement';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'emplacement' => ['required','unique:stock_emplacements,emplacement,NULL,id,deleted_at,NULL',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'emplacement' => ['required','unique:stock_emplacements,emplacement,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'types affectation',
    //     'modeltype' => 'du type d’affectation',
    //     'index_route' => 'StockEmplacementController@index',
    //     'create_route' => 'StockEmplacementController@create',
    //     'store_route' => 'StockEmplacementController@store',
    //     'show_route' => 'StockEmplacementController@show',
    //     'edit_route' => 'StockEmplacementController@edit',
    //     'update_route' => 'StockEmplacementController@update',
    //     'destroy_route' => 'StockEmplacementController@destroy',
    //     'table_values' => 'stockemplacements.table_values',
    //     'table_headers' => 'stockemplacements.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'stockemplacements',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'stockemplacements.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'stockemplacements.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'stockemplacements.edit',
    //     'model_fields' => 'stockemplacements.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'stockemplacements.show',
    //   ],
    //   'field_label' => 'libelle',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('emplacement', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut du StockEmplacement.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie toutes les affectations-articles.
     */
    public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle', 'stock_emplacement_id')
        ->whereNull('date_fin');
    }
}
