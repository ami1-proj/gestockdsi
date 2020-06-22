<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class EtatArticle extends AppBaseModel
{
    use SoftDeletes;

    protected $guarded = [];

    public static $model_name = 'Etat Article';

    public static $view_folder = 'etatarticles';
    public static $view_fields = 'etatarticles.fields';
    public static $view_table_values = 'etatarticles.table_values';
    public static $view_table_headers = 'etatarticles.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'etatarticle';
    public static $unique_fields = [];

    public static $det_sing = 'l’';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l’';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'etat article';
    public static $title_plu = 'etats article';

    public static $route_index = 'EtatArticleController@index';
    public static $route_create = 'EtatArticleController@create';
    public static $route_store = 'EtatArticleController@store';
    public static $route_show = 'EtatArticleController@show';
    public static $route_edit = 'EtatArticleController@edit';
    public static $route_update = 'EtatArticleController@update';
    public static $route_destroy = 'EtatArticleController@destroy';

    public static $breadcrumb_index = 'etatarticles';
    public static $breadcrumb_create = 'etatarticles.create';
    public static $breadcrumb_show = 'etatarticles.show';
    public static $breadcrumb_edit = 'etatarticles.edit';

    public static $denomination_field = 'libelle';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'libelle' => ['required','unique:etat_articles,libelle,NULL,id,deleted_at,NULL',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'libelle' => ['required','unique:etat_articles,libelle,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'etats article',
    //     'modeltype' => 'de l’Etat d’article',
    //     'index_route' => 'EtatArticleController@index',
    //     'create_route' => 'EtatArticleController@create',
    //     'store_route' => 'EtatArticleController@store',
    //     'show_route' => 'EtatArticleController@show',
    //     'edit_route' => 'EtatArticleController@edit',
    //     'update_route' => 'EtatArticleController@update',
    //     'destroy_route' => 'EtatArticleController@destroy',
    //     'table_values' => 'etatarticles.table_values',
    //     'table_headers' => 'etatarticles.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'etatarticles',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'etatarticles.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'etatarticles.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'etatarticles.edit',
    //     'model_fields' => 'etatarticles.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'etatarticles.show',
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
     * Renvoie le Statut de EtatArticle.
     */
    public function statut() {
      return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Article qui sont dans cet etat (EtatArticle).
     */
    public function articles() {
      return $this->hasMany('App\Article', 'etat_article_id');
    }
}
