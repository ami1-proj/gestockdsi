<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\TypeArticle;

class ArticlesEtTypesController extends Controller
{
    public function index()
    {
        $articles = Article::get();
        $articles_enstock = Article::where('affectation_id', 1)->get();
        $articles_enaffectation = Article::where('affectation_id', '<>', 1)->get();
        $typearticles = TypeArticle::withCount(['articles','articles_enstock','articles_enaffectation','articles_neuf','articles_enpanne'])->get();

        return view('articlesettypes.index')
          ->with('articles', $articles)
          ->with('typearticles', $typearticles)
          ->with('articles_enstock', $articles_enstock)
          ->with('articles_enaffectation', $articles_enaffectation)
          ;
    }
}
