<?php

namespace App\Http\Controllers;

use App\EtatArticle;

use Illuminate\Http\Request;
use App\Http\Requests\EtatArticleRequest;
use App\Http\Requests\EtatArticleCreateRequest;
use App\Http\Requests\EtatArticleEditRequest;

use App\Traits\EtatArticleTrait;


class EtatArticleController extends Controller
{
    use EtatArticleTrait;

    function __construct()
    {
         $this->middleware('permission:etat_article-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->redirectToParametre();
    }

    private function redirectToParametre(){
        return redirect()->action('ParametreController@index', ['active_tab' => 'etatarticle']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etatarticle = $this->getDefaultObject(new EtatArticle());

        return view('etatarticles.create')
          ->with('etatarticle', $etatarticle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtatArticleCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New Employe
        $etatarticle = EtatArticle::create($formInput);
        //$this->unsetDefault($etatarticle);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Etat Article'] ));

        //return redirect()->action('ParametreController@index');
        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function show(EtatArticle $etatarticle)
    {
        $etatarticle = EtatArticle::with(['statut'])->where('id', $etatarticle->id)->first();
        return view('etatarticles.show', ['etatarticle' => $etatarticle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(EtatArticle $etatarticle)
    {
        $selectedtags = $this->getTags($etatarticle->tags);

        return view('etatarticles.edit')
          ->with('selectedtags', $selectedtags)
          ->with('etatarticle', $etatarticle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function update(EtatArticleEditRequest $request, EtatArticle $etatarticle)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $etatarticle->fill($formInput);
        $etatarticle->save();
        //$this->unsetDefault($etatarticle);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Etat Article'] ));

        //return redirect()->action('ParametreController@index');
        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EtatArticle  $etatArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtatArticle $etatarticle)
    {
        $etatarticle->delete();
        //$this->unsetDefault($etatarticle);

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Etat Article'] ));

        //return redirect()->action('ParametreController@index');
        return $this->redirectToParametre();
    }
}
