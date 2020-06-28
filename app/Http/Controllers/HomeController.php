<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\TypeArticle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
     {
         $articles = Article::get();
         $articles_enstock = Article::where('affectation_id', 1)->get();
         $articles_enaffectation = Article::where('affectation_id', '<>', 1)->get();
         $typearticles = TypeArticle::withCount(['articles','articles_enstock','articles_enaffectation','articles_neuf','articles_enpanne'])->get();

         return view('welcome')
           ->with('articles', $articles)
           ->with('typearticles', $typearticles)
           ->with('articles_enstock', $articles_enstock)
           ->with('articles_enaffectation', $articles_enaffectation)
           ;
     }
}
