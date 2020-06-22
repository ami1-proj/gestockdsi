<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Fournisseur extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Fournisseur';

    public static $view_folder = 'fournisseurs';
    public static $view_fields = 'fournisseurs.fields';
    public static $view_table_values = 'fournisseurs.table_values';
    public static $view_table_headers = 'fournisseurs.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'fournisseur';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'fournisseur';
    public static $title_plu = 'fournisseurs';

    public static $route_index = 'FournisseurController@index';
    public static $route_create = 'FournisseurController@create';
    public static $route_store = 'FournisseurController@store';
    public static $route_show = 'FournisseurController@show';
    public static $route_edit = 'FournisseurController@edit';
    public static $route_update = 'FournisseurController@update';
    public static $route_destroy = 'FournisseurController@destroy';

    public static $breadcrumb_index = 'fournisseurs';
    public static $breadcrumb_create = 'fournisseurs.create';
    public static $breadcrumb_show = 'fournisseurs.show';
    public static $breadcrumb_edit = 'fournisseurs.edit';

    public static $denomination_field = 'raison_sociale';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
          'nom' => ['required'],
      ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'nouveau_email' => ['required'],
          'nouveau_phone' => ['required'],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [

      ]);
    }
    public static function validationMessages() {
      return [];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'fournisseurs',
    //     'modeltype' => 'du fournisseur',
    //     'index_route' => 'FournisseurController@index',
    //     'create_route' => 'FournisseurController@create',
    //     'store_route' => 'FournisseurController@store',
    //     'show_route' => 'FournisseurController@show',
    //     'edit_route' => 'FournisseurController@edit',
    //     'update_route' => 'FournisseurController@update',
    //     'destroy_route' => 'FournisseurController@destroy',
    //     'table_values' => 'fournisseurs.table_values',
    //     'table_headers' => 'fournisseurs.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'fournisseurs',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'model_fields' => 'fournisseurs.fields',
    //     'morecontrols' => [],
    //     'breadcrumb_title' => 'fournisseurs.create',
    //     'breadcrumb_param' => '',
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'fournisseurs.edit',
    //     'model_fields' => 'fournisseurs.fields',
    //     'morecontrols' => [],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'fournisseurs.show',
    //   ],
    //   'field_label' => 'raison_sociale',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      $phonenums = Phonenum::search($q)->get()->pluck('id')->toArray();
      $fournisseurs_phonenums = DB::table('fournisseur_phonenum')->whereIn('phonenum_id', $phonenums)->get()->pluck('fournisseur_id')->toArray();

      $adresseemails = Adresseemail::search($q)->get()->pluck('id')->toArray();
      $fournisseurs_adresseemails = DB::table('adresseemail_fournisseur')->whereIn('adresseemail_id', $adresseemails)->get()->pluck('fournisseur_id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhere('prenom', 'LIKE', "%{$q}%")
        ->orWhere('raison_sociale', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('id', $fournisseurs_phonenums)
        ->orWhereIn('id', $fournisseurs_adresseemails)
        ;
    }

    /**
    * Get the user's full concatenated name.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getRaisonSocialeAttribute()
    {
        return "{$this->nom} {$this->prenom}";
    }

    /**
     * Renvoie le Statut de Fournisseur.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Retourne tous les Article de ce Fournisseur.
     */
    public function articles() {
        return $this->hasMany('App\Article', 'fournisseur_id');
    }

    /**
     * Renvoie les numéro de téléphone (Phonenum) de ce Fournisseur.
     */
     public function phonenums() {
       if ($this->trashed()) {
         return $this->belongsToMany('App\Phonenum')
          ->withTrashed()
          ->withPivot('rang', 'statut_id')->withTimestamps();
       } else {
         return $this->belongsToMany('App\Phonenum')
           ->withPivot('rang', 'statut_id')->withTimestamps();
       }
     }

     /**
      * Renvoie les e-mails (Adresseemail) de ce Fournisseur.
      */
      public function adresseemails() {
         return $this->belongsToMany('App\Adresseemail')
           ->withPivot('rang', 'statut_id')->withTimestamps();
      }
}
