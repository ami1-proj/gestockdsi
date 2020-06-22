<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;


class FonctionEmploye extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Fonction Employe';

    public static $view_folder = 'fonctionemployes';
    public static $view_fields = 'fonctionemployes.fields';
    public static $view_table_values = 'fonctionemployes.table_values';
    public static $view_table_headers = 'fonctionemployes.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'fonctionemploye';
    public static $unique_fields = [];

    public static $det_sing = 'la';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de la';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'fonction employe';
    public static $title_plu = 'fonctions employe';

    public static $route_index = 'FonctionEmployeController@index';
    public static $route_create = 'FonctionEmployeController@create';
    public static $route_store = 'FonctionEmployeController@store';
    public static $route_show = 'FonctionEmployeController@show';
    public static $route_edit = 'FonctionEmployeController@edit';
    public static $route_update = 'FonctionEmployeController@update';
    public static $route_destroy = 'FonctionEmployeController@destroy';

    public static $breadcrumb_index = 'fonctionemployes';
    public static $breadcrumb_create = 'fonctionemployes.create';
    public static $breadcrumb_show = 'fonctionemployes.show';
    public static $breadcrumb_edit = 'fonctionemployes.edit';

    public static $denomination_field = 'intitule';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'intitule' => ['required','string','min:3','max:100',
            'unique:fonction_employes,intitule,NULL,id,deleted_at,NULL',
          ],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
        'intitule' => ['required','string','min:3','max:100',
          'unique:fonction_employes,intitule,'.$model->id.',id,deleted_at,NULL',
        ],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'fonctions Employe',
    //     'modeltype' => 'de la fonction',
    //     'index_route' => 'FonctionEmployeController@index',
    //     'create_route' => 'FonctionEmployeController@create',
    //     'store_route' => 'FonctionEmployeController@store',
    //     'show_route' => 'FonctionEmployeController@show',
    //     'edit_route' => 'FonctionEmployeController@edit',
    //     'update_route' => 'FonctionEmployeController@update',
    //     'destroy_route' => 'FonctionEmployeController@destroy',
    //     'table_values' => 'fonctionemployes.table_values',
    //     'table_headers' => 'fonctionemployes.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'fonctionemployes',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'fonctionemployes.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'fonctionemployes.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'fonctionemployes.edit',
    //     'model_fields' => 'fonctionemployes.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'fonctionemployes.show',
    //   ],
    //   'field_label' => 'intitule',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('intitule', 'LIKE', "%{$q}%")
        ->orWhere('description', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ;
    }

    /**
     * Renvoie le Statut de la Fonction.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Employe qui ont cette fonction.
     */
    public function employes()
    {
        return $this->hasMany('App\Employe', 'fonction_employe_id');
    }
}
