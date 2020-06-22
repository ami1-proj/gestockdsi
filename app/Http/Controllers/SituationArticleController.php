<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;   

use App\SituationArticle;
use Illuminate\Http\Request;

use App\Http\Requests\SituationArticleRequest;

class SituationArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $recherche_cols = ['id', 'libelle'];

        $sortBy = 'id';  
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $situationarticles = SituationArticle::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('situationarticles.index', compact('situationarticles', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        return view('situationarticles.create')
          ->with('statuts', $statuts)
          ->with('situationarticle', (new SituationArticle()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SituationArticleRequest $request)
    {
        $formInput = $request->all();

        // Store the New TypeArticle
        $typearticle = SituationArticle::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Situation'] ));

        return redirect()->action('SituationArticleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SituationArticle  $situationArticle
     * @return \Illuminate\Http\Response
     */
    public function show(SituationArticle $situationarticle)
    {
         $situationarticle = SituationArticle::with('statut')->where('id', $situationarticle->id)->first();
        return view('situationarticles.show', ['situationarticle' => $situationarticle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SituationArticle  $situationArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(SituationArticle $situationArticle)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        return view('situationarticles.edit')
          ->with('statuts', $statuts)
          ->with('situationarticle', $situationArticle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SituationArticle  $situationArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SituationArticle $situationArticle)
    {
        $situationarticle->fill($request->input());
        $situationarticle->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'Situation Article'] ));

        return redirect()->action('SituationArticleControllerr@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SituationArticle  $situationArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SituationArticle $situationArticle)
    {
        
         $situationArticle->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Situation Article'] ));

        return redirect()->action('SituationArticleController@index');
    }
}
