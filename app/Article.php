<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Article extends AppBaseModel
{
    use SoftDeletes;

    protected $guarded = [];
    //protected $dateFormat = 'd/m/Y';

    public static $model_name = 'Article';

    public static $view_folder = 'articles';
    public static $view_fields = 'articles.fields';
    public static $view_table_values = 'articles.table_values';
    public static $view_table_headers = 'articles.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = ['marquearticles.add_withmodal_form'];

    public static $var_name_single = 'article';
    public static $unique_fields = [];

    public static $det_sing = 'l’';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l’';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'article';
    public static $title_plu = 'articles';

    public static $route_index = 'ArticleController@index';
    public static $route_create = 'ArticleController@create';
    public static $route_store = 'ArticleController@store';
    public static $route_show = 'ArticleController@show';
    public static $route_edit = 'ArticleController@edit';
    public static $route_update = 'ArticleController@update';
    public static $route_destroy = 'ArticleController@destroy';

    public static $breadcrumb_index = 'articles';
    public static $breadcrumb_create = 'articles.create';
    public static $breadcrumb_show = 'articles.show';
    public static $breadcrumb_edit = 'articles.edit';

    public static $denomination_field = 'reference_complete';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
        'reference' => ['required',],
        'date_livraison' => ['required',],
        'type_article_id' => ['required',],
        'etat_article_id' => ['required',],
        'marque_article_id' => ['required',],
        'fournisseur_id' => ['required',],
        'affectation_id' => ['required',],
        'statut_id' => ['required',],
      ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [

      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [

      ]);
    }
    public static function validationMessages() {
      return [
        'reference.required' => 'Prière de renseigner une référence',
        'taille.required' => 'Prière de renseigner la taille',
        'reference.min:3' => 'La référence doit comporter au moins 3 caractères',
        'reference.min:3' => 'La référence doit comporter au trop 100 caractères',
        'date_livraison.required' => 'Prière de renseigner la date de Livraison',
        'date_livraison.date' => 'La date de Livraison doit avoir un format de date valide',
        'statut_id.required' => 'Prière de rensigner le Statut',
        'type_article_id.required' => 'Prière de rensigner le Type de l article',
        'fournisseur_id.required' => 'Prière de rensigner le Fournisseur de l article',
        'marque_article_id.required' => 'Prière de rensigner la Marque de l article',
        'etat_article_id.required' => 'Prière de rensigner l Etat de l article',
        'affectation_id.required' => 'Prière de rensigner l Affectation de l article',
      ];
    }

    // public static $view_attributes_array = [
    //   'raw' => [
    //     'title' => 'articles',
    //     'modeltype' => 'de l’article',
    //     'index_route' => 'ArticleController@index',
    //     'create_route' => 'ArticleController@create',
    //     'store_route' => 'ArticleController@store',
    //     'show_route' => 'ArticleController@show',
    //     'edit_route' => 'ArticleController@edit',
    //     'update_route' => 'ArticleController@update',
    //     'destroy_route' => 'ArticleController@destroy',
    //     'table_values' => 'articles.table_values',
    //     'table_headers' => 'articles.table_headers',
    //     'affectation_tag' => '',
    //   ],
    //   'index' => [
    //     'breadcrumb_title' => 'articles',
    //     'breadcrumb_param' => '',
    //   ],
    //   'create' => [
    //     'breadcrumb_title' => 'articles.create',
    //     'breadcrumb_param' => '',
    //     'model_fields' => 'articles.fields',
    //     'morecontrols' => [],
    //     'moreforms' => ['marquearticles.add_withmodal_form'],
    //   ],
    //   'edit' => [
    //     'breadcrumb_title' => 'articles.edit',
    //     'model_fields' => 'articles.fields',
    //     'morecontrols' => [],
    //     'moreforms' => ['marquearticles.add_withmodal_form'],
    //   ],
    //   'show' => [
    //     'breadcrumb_title' => 'articles.show',
    //   ],
    //   'field_label' => 'reference_complete',
    // ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [
    //     'date_livraison',
    // ];

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $typearticles = TypeArticle::search($q)->get()->pluck('id')->toArray();
      $marques = MarqueArticle::search($q)->get()->pluck('id')->toArray();
      $fournisseurs = Fournisseur::search($q)->get()->pluck('id')->toArray();
      $etatarticles = EtatArticle::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('reference', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('type_article_id', $typearticles)
        ->orWhereIn('marque_article_id', $marques)
        ->orWhereIn('fournisseur_id', $fournisseurs)
        ->orWhereIn('etat_article_id', $etatarticles);
    }

    /**
     * Filtre les articles en stock et en etat d etre affecte
     * @param  var $query la requete entrante
     * @return var        La requete sortante
     */
    public function scopeDisponibles($query) {
      return $query
        ->where('affectation_id', 1)
        ->where('etat_article_id', '!=', 3);
    }

    public function scopeEnStock($query) {
      return $query
        ->where('affectation_id', 1)
        ;
    }

    /**
    * Get the user's full concatenated name.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getReferenceCompleteAttribute()
    {
        return "{$this->typeArticle->libelle} - {$this->marqueArticle->nom} - {$this->id} - {$this->reference}";
    }

    /**
     * Renvoie le Statut de l'Article.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le marque (MarqueArticle) de l'Article.
     */
    public function marqueArticle() {
        return $this->belongsTo('App\MarqueArticle');
    }

    /**
     * Renvoie le Fournisseur de l'Article.
     */
    public function fournisseur() {
        return $this->belongsTo('App\Fournisseur');
    }

    /**
     * Renvoie le type (TypeArticle) de l'Article.
     */
    public function typeArticle() {
        return $this->belongsTo('App\TypeArticle');
    }

    /**
     * Renvoie la situation (SituationArticle) de l'Article.
     */
    public function situationArticle() {
        return $this->belongsTo('App\SituationArticle');
    }

    public function situation()
    {
        if ( is_null($this->affectation_id)) { return null; }

        return Affectation::find($this->affectation_id);
    }

    /**
     * Renvoie l'etat (EtatArticle) de l'Article.
     */
    public function etatArticle() {
        return $this->belongsTo('App\EtatArticle');
    }

    public function affectations() {
        // return $this->belongsToMany('App\Affectation')
        //     ->withPivot('type_mouvement_id','affectation_from_id','stock_emplacement_id','details','date_debut','date_fin','statut_id')
        //     ->withTimestamps()
        //     ->orderBy('created_at', 'desc');
        return $this->affectationarticles()->get('affectation');
    }

    public function affectationarticles() {
        return $this->hasMany('App\AffectationArticle', 'article_id');
    }

    public function affectation() {
        //return $this->affectations()->first();
        $last_affectationarticle = $this->affectationarticles()->whereNull('date_fin')->first();
        //dd($this->affectationarticles(), $last_affectationarticle);
        return $last_affectationarticle;
    }

    public function affecter($affectation_id, $mouvement_id, $details_mouvement = null) {
        $default_emplacement_id = 1;
        $default_statut_id = Statut::default()->first()->id;

        // 1. ancienne affectation
        // if (is_null($this->affectation())) {
        //     $old_affectation_id = null;
        // } else {
        //
        //     $old_affectation = $this->affectation()->affectation;
        //     $old_affectation_id = $old_affectation->id;
        // }
        // 1. On termine l affectation en cours et on la recupère
        $affectation_article_old = $this->terminerAffectation($details_mouvement);

        $new_affectationarticle = AffectationArticle::create([
            'article_id' => $this->id,
            'affectation_id' => $affectation_id,
            'type_mouvement_id' => $mouvement_id,
            //'affectation_from_id' => $old_affectation_id,
            'stock_emplacement_id' => $default_emplacement_id,
            'details_debut' => $details_mouvement,
            'statut_id' => $default_statut_id,
            'date_debut' => now(),
        ]);

        // 2. On met a jour la nouvelle affectation de cet article
        $this->affectation_id = $affectation_id;
        $this->save();

        // 4. Si tout s'est bien passé, on renseigne les liens (précédent et suivant)
        //dd($affectation_article_old);
        if (! is_null($affectation_article_old)) {
          $new_affectationarticle->prev_affectationarticle_id = $affectation_article_old->id;
          $new_affectationarticle->save();
          $affectation_article_old->next_affectationarticle_id = $new_affectationarticle->id;
          $affectation_article_old->save();
        }
    }

    public function desaffecter($mouvement_id, $details_mouvement = null) {
        $default_affectation_id = 1;

        return $this->affecter($default_affectation_id, $mouvement_id, $details_mouvement);
    }

    public function terminerAffectation($details_fin)
    {
        $affectation_article_old = null;
        if (!( is_null($this->affectation()) )) {
          // marque la fin de la derniere affectation
          $affectation_article_old = AffectationArticle::find($this->affectation()->id);
          if (! is_null($affectation_article_old) ) {
            $affectation_article_old->terminer($details_fin);
          }
        }
        return $affectation_article_old;
    }

}
