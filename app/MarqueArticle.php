<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class MarqueArticle extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Marque';

    public static $view_folder = 'marquearticles';
    public static $view_fields = 'marquearticles.fields';
    public static $view_table_values = 'marquearticles.table_values';
    public static $view_table_headers = 'marquearticles.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'marquearticle';
    public static $unique_fields = [];

    public static $det_sing = 'la';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de la';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'marque article';
    public static $title_plu = 'marques article';

    public static $route_index = 'MarqueArticleController@index';
    public static $route_create = 'MarqueArticleController@create';
    public static $route_store = 'MarqueArticleController@store';
    public static $route_show = 'MarqueArticleController@show';
    public static $route_edit = 'MarqueArticleController@edit';
    public static $route_update = 'MarqueArticleController@update';
    public static $route_destroy = 'MarqueArticleController@destroy';

    public static $breadcrumb_index = 'marquearticles';
    public static $breadcrumb_create = 'marquearticles.create';
    public static $breadcrumb_show = 'marquearticles.show';
    public static $breadcrumb_edit = 'marquearticles.edit';

    public static $denomination_field = 'nom';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'nom' => ['required','unique:marque_articles,nom,NULL,id,deleted_at,NULL',
        ],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'nom' => ['required','string','min:3','max:100','unique:marque_articles,nom,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [
        'libelle.required' => 'Prière de renseigner le libelle',
      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'marques Article',
    //     'modeltype' => 'de la marque',
    //     'index_route' => 'MarqueArticleController@index',
    //     'create_route' => 'MarqueArticleController@create',
    //     'store_route' => 'MarqueArticleController@store',
    //     'show_route' => 'MarqueArticleController@show',
    //     'edit_route' => 'MarqueArticleController@edit',
    //     'update_route' => 'MarqueArticleController@update',
    //     'destroy_route' => 'MarqueArticleController@destroy',
    //     'table_values' => 'marquearticles.table_values',
    //     'table_headers' => 'marquearticles.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'marquearticles',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'marquearticles.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'marquearticles.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'marquearticles.edit',
    //     'model_fields' => 'marquearticles.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'marquearticles.show',
    //   ],
    //   'field_label' => 'nom',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut de la MarqueArticle.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Article de cette marque (MarqueArticle).
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'marque_article_id');
    }
}
