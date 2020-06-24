<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Employe extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;

    public static $model_name = 'Employe';

    public static $view_folder = 'employes';
    public static $view_fields = 'employes.fields';
    public static $view_table_values = 'employes.table_values';
    public static $view_table_headers = 'employes.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = ['fonctionemployes.add_withmodal_form'];

    public static $var_name_single = 'employe';
    public static $unique_fields = [];

    public static $det_sing = 'l’';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l’';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'employe';
    public static $title_plu = 'employes';

    public static $route_index = 'EmployeController@index';
    public static $route_create = 'EmployeController@create';
    public static $route_store = 'EmployeController@store';
    public static $route_show = 'EmployeController@show';
    public static $route_edit = 'EmployeController@edit';
    public static $route_update = 'EmployeController@update';
    public static $route_destroy = 'EmployeController@destroy';

    public static $breadcrumb_index = 'employes';
    public static $breadcrumb_create = 'employes.create';
    public static $breadcrumb_show = 'employes.show';
    public static $breadcrumb_edit = 'employes.edit';

    public static $denomination_field = 'nom_complet';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
        'nom' => ['required','string','min:3','max:255',],
        'fonction_employe_id' => ['required','integer',],
      ];
    }
    public static function createRules()  {
      return array_merge(self::defaultRules(), [
          'nouveau_email' => ['required'],
          'nouveau_phone' => ['required'],
          'matricule' => ['required','unique:employes,matricule,NULL,id,deleted_at,NULL',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'matricule' => ['required','unique:employes,matricule,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $fonctionemployes = FonctionEmploye::search($q)->get()->pluck('id')->toArray();

      $departements = Departement::search($q, 'employe')->get()->pluck('id')->toArray();

      $phonenums = Phonenum::search($q)->get()->pluck('id')->toArray();
      $employes_phonenums = DB::table('employe_phonenum')->whereIn('phonenum_id', $phonenums)->get()->pluck('employe_id')->toArray();

      $adresseemails = Adresseemail::search($q)->get()->pluck('id')->toArray();
      $employes_adresseemails = DB::table('adresseemail_employe')->whereIn('adresseemail_id', $adresseemails)->get()->pluck('employe_id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhere('prenom', 'LIKE', "%{$q}%")
        ->orWhere('matricule', 'LIKE', "%{$q}%")
        ->orWhere('adresse', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('fonction_employe_id', $fonctionemployes)
        ->orWhereIn('departement_id', $departements)
        ->orWhereIn('id', $employes_phonenums)
        ->orWhereIn('id', $employes_adresseemails)
        ;
    }

    /**
    * Get the employe's full concatenated name.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getNomCompletAttribute()
    {
        return "{$this->nom} {$this->prenom}";
    }

    /**
     * Renvoie le Statut de Employe.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie la Fonction de l employe.
     */
    public function fonction() {
        return $this->belongsTo('App\FonctionEmploye', 'fonction_employe_id');
    }

    /**
     * Renvoie l Assignation de l employe.
     */
    public function departement() {
        return $this->belongsTo('App\Departement');
    }


    /**
     * Retourne toutes les Departements pour lesquelles cet employe est responsable.
     */
    public function departementsResponsable() {
        return $this->hasMany('App\Departement', 'employe_responsable_id');
    }

    /**
     * Renvoie les numéro de téléphone (Phonenum) de cet Employe.
     */
     public function phonenums() {
        return $this->belongsToMany('App\Phonenum')
          ->withPivot('rang', 'statut_id')->withTimestamps()
          ->orderBy('rang','asc');
     }

     /**
      * Renvoie les e-mails (Adresseemail) de cet Employe.
      */
      public function adresseemails() {
         return $this->belongsToMany('App\Adresseemail')
           ->withPivot('rang', 'statut_id')->withTimestamps()
           ->orderBy('rang','asc');
      }

      // public function affectations() {
      //   return $this->hasMany('App\Affectation', 'employe_id')
      //     ->whereNull('date_fin');
      // }

      public function affectations() {
          $typeaffectation = TypeAffectation::tagged('Employe')->first();

          return $this->hasMany('App\Affectation', 'beneficiaire_id')
            ->where('type_affectation_id', $typeaffectation->id)
            ->whereNull('date_fin');
      }
}
