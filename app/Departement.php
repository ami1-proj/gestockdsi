<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\TypeAffectation;

use App\Traits\RelationshipsTrait;

class Departement extends AppBaseModel
{
    protected $guarded = [];
    use SoftDeletes;
    use RelationshipsTrait;

    public static $model_name = 'Departement';

    public static $view_folder = 'departements';
    public static $view_fields = 'departements.fields';
    public static $view_table_values = 'departements.table_values';
    public static $view_table_headers = 'departements.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'departement';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'departement';
    public static $title_plu = 'departements';

    public static $route_index = 'DepartementController@index';
    public static $route_create = 'DepartementController@create';
    public static $route_store = 'DepartementController@store';
    public static $route_show = 'DepartementController@show';
    public static $route_edit = 'DepartementController@edit';
    public static $route_update = 'DepartementController@update';
    public static $route_destroy = 'DepartementController@destroy';

    public static $breadcrumb_index = 'departements';
  	public static $breadcrumb_create = 'departements.create';
  	public static $breadcrumb_show = 'departements.show';
  	public static $breadcrumb_edit = 'departements.edit';

    public static $denomination_field = 'chemin_complet';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    // public function listRelations() {
    //   $model_class = \App\Departement::class;
    //   $reflector = new \ReflectionClass($model_class);
    //   $relations = [];
    //   foreach ($reflector->getMethods() as $reflectionMethod) {
    //       $returnType = $reflectionMethod->getReturnType();
    //       if ($returnType) {
    //           if (in_array(class_basename($returnType->getName()), ['hasOne', 'hasMany', 'belongsTo', 'belongsToMany', 'morphToMany', 'morphTo'])) {
    //               $relations[] = $reflectionMethod;
    //           }
    //       }
    //   }
    //
    //   return $relations;
    // }

    public static function defaultRules() {
      return [
        'intitule' => ['required','string','min:3','max:100',],
        'type_departement_id' => ['required',],
      ];
    }
    public static function createRules()  {
      return array_merge(self::defaultRules(), [
          'chemin_complet' => ['unique:departements,chemin_complet,NULL,id,deleted_at,NULL'],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'chemin_complet' => ['unique:departements,chemin_complet,'.$model->id.',id,deleted_at,NULL',],
      ]);
    }
    public static function validationMessages() {
      return [
        'type_departement_id.required' => 'Prière de sélectionner un Type Département',
        'chemin_complet.unique' => 'Il existe déjà un département de même intitulé pour ce Parent',
      ];
    }

      

    public function scopeSearch($query, $q, $caller) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      if ($caller == 'departement') {
        $employes = Employe::search($q, $caller)->get()->pluck('id')->toArray();

        return $query
          ->where('intitule', 'LIKE', "%{$q}%")
          ->orWhere('chemin_complet', 'LIKE', "%{$q}%")
          ->orWhereIn('statut_id', $statuts)
          ->orWhereIn('employe_responsable_id', $employes)
        ;
      } else {
        return $query
          ->where('intitule', 'LIKE', "%{$q}%")
          ->orWhere('chemin_complet', 'LIKE', "%{$q}%")
          ->orWhereIn('statut_id', $statuts)
        ;
      }
    }

    /**
     * Renvoie le Statut du Departement.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
      * Renvoie l'employe responsable du Departement.
      */
    public function typedepartement() {
        return $this->belongsTo('App\TypeDepartement', 'type_departement_id');
    }

    /**
      * Renvoie le Departement du Departement.
      */
    public function parent() {
        return $this->belongsTo('App\Departement', 'departement_parent_id');
    }

    /**
     * Renvoie les employés de ce Departement.
     */
    public function employes() {
        return $this->hasMany('App\Employe');
    }

    /**
     * Renvoie les departement departementenfants du Departement.
     */
    public function departementenfants() {
        return $this->hasMany('App\Departement', 'departement_parent_id');
    }

    /**
     * Renvoie l'employe responsable du Departement.
     */
    public function employeResponsable() {
        return $this->belongsTo('App\Employe', 'employe_responsable_id');
    }

    public function affectations() {
        $typeaffectation = TypeAffectation::tagged('Departement')->first();

        return $this->hasMany('App\Affectation', 'beneficiaire_id')
          ->where('type_affectation_id', $typeaffectation->id)
          ->whereNull('date_fin');
    }

    public static function getCheminComplet($intitule, $parent_id) {
      if (is_null($parent_id)) {
        return $intitule;
      } else {
        $parent = Departement::find($parent_id);

        return $parent->chemin_complet . ' > ' . $intitule;
      }
    }

    public static function boot(){
        parent::boot();

        // Après chaque modification
        self::updated(function($model){
            // On reconstruit le chemin complet
            $model->rebuildCheminComplet();
            // On reconstruit les chemins complet de tous les enfants
            foreach ($model->departementenfants as $departementenfant) {
              $departementenfant->rebuildCheminComplet();
            }
        });
    }

    /**
     * Reconstruit le chemin complet du Depatement
     * @return void
     */
    private function rebuildCheminComplet() {
      $new_chemin_complet = Departement::getCheminComplet($this->intitule, $this->departement_parent_id);
      if ($this->chemin_complet == $new_chemin_complet) {
        // nothing to do
      } else {
        // we set the new one
        $this->chemin_complet = $new_chemin_complet;
        $this->save();
      }
    }
}
