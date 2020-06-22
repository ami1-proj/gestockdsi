<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use App\Article;
use App\TypeArticle;

use App\Traits\StockTrait;

class StockController extends Controller
{
    use StockTrait;

    function __construct()
    {
         $this->middleware('permission:stock-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         //$articles = Article::get();
         $articles_enstock = Article::enStock()->get();
         $articles_nouveaux = Article::enStock()->where('etat_article_id', 1)->get();
         $articles_enpanne = Article::enStock()->where('etat_article_id', 3)->get();
         $articles_ancien = Article::enStock()->where('etat_article_id', 2)->get();

         $articles_enaffectation = Article::where('affectation_id', '<>', 1)->get();

         $typearticles = TypeArticle::withCount(['articles','articles_enstock','articles_enaffectation','articles_neuf','articles_enpanne'])->get();

         return view('stocks.index')
           //->with('articles', $articles)
           ->with('typearticles', $typearticles)
           ->with('articles_enstock', $articles_enstock)
           ->with('articles_enaffectation', $articles_enaffectation)
           ->with('articles_nouveaux', $articles_nouveaux)
           ->with('articles_enpanne', $articles_enpanne)
           ->with('articles_ancien', $articles_ancien)
           ;
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
