<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PermissionTrait;
use App\Traits\AppBaseTrait;
use App\Traits\RecycleBinTrait;
use App\Traits\ObservantTrait;
use App\Traits\DefaultTrait;
use App\Traits\RelationshipsTrait;

class Statut extends Model
{
    use PermissionTrait;
    use AppBaseTrait;
    use RecycleBinTrait;
    use ObservantTrait;
    use DefaultTrait;
    use RelationshipsTrait;

    protected $guarded = [];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public static $model_name = 'Statut';

    public static $view_folder = 'statuts';
    public static $view_fields = 'statuts.fields';
    public static $view_table_values = 'statuts.table_values';
    public static $view_table_headers = 'statuts.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'statut';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'statuts';
    public static $title_plu = 'statut';

    public static $route_index = 'StatutController@index';
    public static $route_create = 'StatutController@create';
    public static $route_store = 'StatutController@store';
    public static $route_show = 'StatutController@show';
    public static $route_edit = 'StatutController@edit';
    public static $route_update = 'StatutController@update';
    public static $route_destroy = 'StatutController@destroy';

    public static $breadcrumb_index = 'statuts';
    public static $breadcrumb_create = 'statuts.create';
    public static $breadcrumb_show = 'statuts.show';
    public static $breadcrumb_edit = 'statuts.edit';

    public static $denomination_field = 'nom';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
          'libelle' => ['required',],
      ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'code' => ['required','unique:statuts,code',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'code' => ['required','unique:statuts,code,'.$model->id,],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      return $query
        ->where('libelle', 'LIKE', "%{$q}%");
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

    public function scopeActif($query) {
      return $query
        ->where('code', 'actif');
    }

    public function scopeInActif($query) {
      return $query
        ->where('code', 'inactif');
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
     * Retourne toutes les relations AffectationArticle qui ont ce Statut.
     */
    public function affectationarticles()
    {
        return $this->hasMany('App\AffectationArticle', 'statut_id');
    }

    /**
     * Retourne toutes les Commande qui ont ce Statut.
     */
    public function commandes()
    {
        return $this->hasMany('App\Commande', 'statut_id');
    }

    /**
     * Retourne tous les EtatCommande qui ont ce Statut.
     */
    public function etatcommandes()
    {
        return $this->hasMany('App\EtatCommande', 'statut_id');
    }

    /**
     * Retourne tous les StockEmplacement qui ont ce Statut.
     */
    public function stockemplacements()
    {
        return $this->hasMany('App\StockEmplacement', 'statut_id');
    }

    /**
     * Retourne tous les TypeMouvement qui ont ce Statut.
     */
    public function typemouvements()
    {
        return $this->hasMany('App\TypeMouvement', 'statut_id');
    }

    /**
     * Retourne toutes les Affectation qui ont ce Statut.
     */
    public function affectations()
    {
        return $this->hasMany('App\Affectation', 'statut_id');
    }

    /**
     * Retourne tous les Article qui ont ce Statut.
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'statut_id');
    }

    /**
     * Retourne tous les TypeAffectation qui ont ce Statut.
     */
    public function typeAffectations()
    {
        return $this->hasMany('App\TypeAffectation', 'statut_id');
    }

    /**
     * Retourne toutes les MarqueArticle qui ont ce Statut.
     */
    public function marquearticles()
    {
        return $this->hasMany('App\MarqueArticle', 'statut_id');
    }

    /**
     * Retourne tous les EtatArticle qui ont ce Statut.
     */
    public function etatarticles()
    {
        return $this->hasMany('App\EtatArticle', 'statut_id');
    }

    /**
     * Retourne toutes les Departement qui ont ce Statut.
     */
    public function departements()
    {
        return $this->hasMany('App\Departement', 'statut_id');
    }

    /**
     * Retourne toutes les TypeDepartement qui ont ce Statut.
     */
    public function typedepartements()
    {
        return $this->hasMany('App\TypeDepartement', 'statut_id');
    }

    /**
     * Retourne toutes les relations AdresseemailEmploye qui ont ce Statut.
     */
    public function employeadresseemails()
    {
        return $this->hasMany('App\AdresseemailEmploye', 'statut_id');
    }

    /**
     * Retourne toutes les relations EmployePhonenum qui ont ce Statut.
     */
    public function employephonenums()
    {
        return $this->hasMany('App\EmployePhonenum', 'statut_id');
    }

    /**
     * Retourne tous les Employe qui ont ce Statut.
     */
    public function employes()
    {
        return $this->hasMany('App\Employe', 'statut_id');
    }

    /**
     * Retourne tous les FonctionEmploye qui ont ce Statut.
     */
    public function fonctionemployes()
    {
        return $this->hasMany('App\FonctionEmploye', 'statut_id');
    }

    /**
     * Retourne toutes les relations AdresseemailFournisseur qui ont ce Statut.
     */
    public function adresseemailfournisseurs()
    {
        return $this->hasMany('App\AdresseemailFournisseur', 'statut_id');
    }

    /**
     * Retourne toutes les relations FournisseurPhonenum qui ont ce Statut.
     */
    public function fournisseurphonenums()
    {
        return $this->hasMany('App\FournisseurPhonenum', 'statut_id');
    }

    /**
     * Retourne tous les Fournisseur qui ont ce Statut.
     */
    public function fournisseurs()
    {
        return $this->hasMany('App\Fournisseur', 'statut_id');
    }

    /**
     * Retourne toutes les Adresseemail qui ont ce Statut.
     */
    public function adresseemails()
    {
        return $this->hasMany('App\Adresseemail', 'statut_id');
    }

    /**
     * Retourne tous les Phonenum qui ont ce Statut.
     */
    public function phonenums()
    {
        return $this->hasMany('App\Phonenum', 'statut_id');
    }

    /**
     * Retourne tous les Stock qui ont ce Statut.
     */
    public function stocks()
    {
        return $this->hasMany('App\Stock', 'statut_id');
    }

    /**
     * Retourne tous les StockLieu qui ont ce Statut.
     */
    public function stocklieus()
    {
        return $this->hasMany('App\StockLieu', 'statut_id');
    }

    /**
     * Retourne tous les TypeArticle qui ont ce Statut.
     */
    public function typearticles()
    {
        return $this->hasMany('App\TypeArticle', 'statut_id');
    }

    /**
     * Retourne toutes les User qui ont ce Statut.
     */
    public function users()
    {
        return $this->hasMany('App\User', 'statut_id');
    }

    /**
     * Retourne toutes les Role qui ont ce Statut.
     */
    public function roles()
    {
        return $this->hasMany('App\RoleCustom', 'statut_id');
    }
}
