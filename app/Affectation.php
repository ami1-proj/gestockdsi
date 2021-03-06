<?php

namespace App;

use App\Mail\AffectationNew;
use App\Mail\AffectationNewToAdmins;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

/**
 * Class Affectation
 * @package App
 *
 * @property integer $id
 * @property string $objet
 * @property \Illuminate\Support\Carbon $date_debut
 * @property \Illuminate\Support\Carbon|null $date_fin
 * @property integer|null $type_affectation_id
 * @property integer|null $beneficiaire_id
 * @property string|null $fiche_retour
 * @property integer|null $fiche_retour_taille
 * @property integer|null $statut_id
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Affectation extends AppBaseModel
{
    use SoftDeletes;

    protected $guarded = [];

    public static $model_name = 'Affectation';

    public static $view_folder = 'affectations';
    public static $view_fields = 'affectations.fields';
    public static $view_table_values = 'affectations.table_values';
    public static $view_table_headers = 'affectations.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'affectation';
    public static $unique_fields = [];

    public static $det_sing = 'l’';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l’';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'affectation';
    public static $title_plu = 'affectations';

    public static $route_index = 'AffectationController@index';
    public static $route_create = 'AffectationController@create';
    public static $route_store = 'AffectationController@store';
    public static $route_show = 'AffectationController@show';
    public static $route_edit = 'AffectationController@edit';
    public static $route_update = 'AffectationController@update';
    public static $route_destroy = 'AffectationController@destroy';

    public static $breadcrumb_index = 'affectations';
    public static $breadcrumb_create = 'affectations.create';
    public static $breadcrumb_show = 'affectations.show';
    public static $breadcrumb_edit = 'affectations.edit';

    public static $from_index_create = false;

    public static $from_show_create = false;
    public static $from_show_edit = false;
    public static $from_show_delete = false;

    public static $from_edit_delete = false;
    public static $from_edit_show = false;

    public static $denomination_field = 'objet';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
        'articles' => ['required'],
        'date_debut' => ['required','date'],
      ];
    }
    public static function createRules()  {
      return array_merge(self::defaultRules(), [
          'objet' => ['required','unique:affectations,objet,NULL,id,deleted_at,NULL',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'objet' => ['required','unique:affectations,objet,'.$model->id.',id,deleted_at,NULL',],
          'type_mouvement_id' => ['required'],
          'details' => ['required'],
      ]);
    }
    public static function ficheRetourRules() {
        return [
            'fiche_retour' => [
                'required',
                'mimes:pdf',
            ],
        ];
    }
    public static function validationMessages() {
      return [];
    }

		public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('objet', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts);
    }

    /**
     * Renvoie le Statut de l affectation.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le type d affectation.
     */
    public function typeAffectation() {
        return $this->belongsTo('App\TypeAffectation');
    }

    public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle')
          ->orderBy('id')
					// ->whereNull('date_fin')
          ;
    }

    public function articles() {
      if (is_null($this->date_fin)) {
        return $this->articlesNotEnded();
      } else {
        return $this->articlesAll();
      }
    }

    public function articlesAll() {
      $articles = array();
      foreach ($this->affectationarticles as $affectationarticle) {
        $articles[$affectationarticle->article->id] = $affectationarticle->article;
      }
      return \Illuminate\Database\Eloquent\Collection::make($articles);
    }

    public function articlesNotEnded() {
      $articles = array();
      foreach ($this->affectationarticles as $affectationarticle) {
        if ((is_null($affectationarticle->date_fin))) {
          $articles[$affectationarticle->article->id] = $affectationarticle->article;
        }
      }
      return \Illuminate\Database\Eloquent\Collection::make($articles);
    }

    public function beneficiaire() {
      if (is_null($this->typeAffectation)) {
        return null;
      } elseif ($this->typeAffectation->object_class_name == 'Supprime') {
        return null;
      } else {
        return $this->belongsTo($this->typeAffectation->object_class_name, 'beneficiaire_id');
      }
    }

    public function terminer()
    {
        $this->date_fin = now();
        $this->save();
    }

    public function notifierBeneficiaire() {
        if(config('settings.affectation.notifier_beneficiaire')) {
            $email = $this->beneficiaire()->adresseemails->first();
            if ($email) {
                Mail::to($email)
                    ->queue(new AffectationNew($this));
            }
        }
    }

    public function notifierAdminFoncs() {
        if(config('settings.affectation.notifier_adminfonc')) {
            $admins_emails = config('settings.affectation.adminfonc_a_notifier');
            foreach ($admins_emails as $admin_email) {
                if ($admins_emails) {
                    Mail::to($admins_emails)
                        ->queue(new AffectationNewToAdmins($this));
                }
            }
        }
    }
}
