<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class TypeArticle extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Type Article';

    public static $view_folder = 'typearticles';
    public static $view_fields = 'typearticles.fields';
    public static $view_table_values = 'typearticles.table_values';
    public static $view_table_headers = 'typearticles.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'typearticle';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'type article';
    public static $title_plu = 'types article';

    public static $route_index = 'TypeArticleController@index';
    public static $route_create = 'TypeArticleController@create';
    public static $route_store = 'TypeArticleController@store';
    public static $route_show = 'TypeArticleController@show';
    public static $route_edit = 'TypeArticleController@edit';
    public static $route_update = 'TypeArticleController@update';
    public static $route_destroy = 'TypeArticleController@destroy';

    public static $breadcrumb_index = 'typearticles';
    public static $breadcrumb_create = 'typearticles.create';
    public static $breadcrumb_show = 'typearticles.show';
    public static $breadcrumb_edit = 'typearticles.edit';

    public static $denomination_field = 'libelle';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'image' => ['required','image',],
          'libelle' => ['required','unique:type_articles,libelle,NULL,id,deleted_at,NULL'],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'image' => ['sometimes','image',],
          'libelle' => ['required','unique:type_articles,libelle,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [
        'libelle.required' => 'Prière de renseigner le Libellé',
      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'types article',
    //     'modeltype' => 'du type d’article',
    //     'index_route' => 'TypeArticleController@index',
    //     'create_route' => 'TypeArticleController@create',
    //     'store_route' => 'TypeArticleController@store',
    //     'show_route' => 'TypeArticleController@show',
    //     'edit_route' => 'TypeArticleController@edit',
    //     'update_route' => 'TypeArticleController@update',
    //     'destroy_route' => 'TypeArticleController@destroy',
    //     'table_values' => 'typearticles.table_values',
    //     'table_headers' => 'typearticles.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'typearticles',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'typearticles.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'typearticles.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'typearticles.edit',
    //     'model_fields' => 'typearticles.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'typearticles.show',
    //   ],
    //   'field_label' => 'libelle',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('libelle', 'LIKE', "%{$q}%")
        ->orWhere('description', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut du TypeArticle.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie tous les Articles du TypeArticle.
     */
    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function articles_enstock() {
        return $this->hasMany('App\Article')
          ->where('affectation_id', 1);
    }

    public function articles_enaffectation() {
        return $this->hasMany('App\Article')
          ->where('affectation_id', '<>', 1);
    }

    public function articles_neuf() {
        return $this->hasMany('App\Article')
          ->where('etat_article_id', 1);
    }

    public function articles_enpanne() {
        return $this->hasMany('App\Article')
          ->where('etat_article_id', 2);
    }
}
