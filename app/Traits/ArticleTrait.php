<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Article;
use App\Stock;
use App\Employe;
use App\Departement;

trait ArticleTrait {
  use StatutTrait;

  public function formatRequestInput($request){
      $formInput = $request->all();
      $formInput = $this->setStatutFromRequestInput($formInput);
      //dd($formInput);
      $formInput['date_livraison'] = str_replace("/", "-", $formInput['date_livraison']);
      //dd($formInput['date_livraison']);
      $formInput['date_livraison'] = Carbon::parse($formInput['date_livraison']);

      return $formInput;
  }

  public function AffecterArticle($article_id, $affectation_id, $elem_id, $emplacement_id = 1){
    // Récupération de l'article dans la base de données
    $article = Article::find($article_id);
    $article->affecter($affectation_id, $elem_id);
  }

  /**
   * Debuter une affectation
   * @param Article $article            article concerne
   * @param various $elem               element a traiter
   * @param array $donnees_pivot_supp donnees supplementaires de la table pivot
   */
  public function DebuterAffectation($article, $elem, $donnees_pivot_supp) {
      $elem->articles()->attach($article->id, $donnees_pivot_supp);
  }

  /**
   * Mettre fin a une affectation d article (renseigner la date de fin)
   * @param Article $article                 article concerne
   * @param string $table_pivot             nom de la table pivot
   * @param string $colonne_fin_affectation nom de la colonne de fin d affectation
   */
  public function FinirAffectation($elem) {
    $elem->terminerAffectation();
  }

  /**
   * Obtenir un tableau definissant l'element a traiter
   * @param  integer  $situation_id   id de la situation dans laquelle basculer l article
   * @param  integer  $elem_id        id de l element auquel affecter l article
   * @return array                  tableau définissant l element
   */
  public function getElemArray($situation_id, $elem_id) {
    if ($situation_id == 1) {
      // stock
      $elem = Stock::find($elem_id);
      $display = $elem->stock->nom;
      $text = 'Gestion des Articles du Stock ';
    } elseif ($situation_id == 2) {
      // employe
      $elem = Employe::find($elem_id);
      $display = $elem->nom_complet;
      $text = 'Gestion des Articles de l Employé ';
    } elseif ($situation_id == 3) {
      // Departement
      $elem = Departement::find($elem_id);
      $display = $elem->full_path;
      $text = 'Gestion des Articles du Département ';
    } else {
      $elem = null;
      $display = null;
      $text = null;
    }
    return ['elem' => $elem, 'display' => $display, 'text' => $text];
  }

}
