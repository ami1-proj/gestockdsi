<?php

namespace App\Http\Controllers;

use App\EtatCommande;

use Illuminate\Http\Request;
use App\Http\Requests\EtatCommandeRequest;
use App\Http\Requests\EtatCommandeCreateRequest;
use App\Http\Requests\EtatCommandeEditRequest;

use App\Traits\EtatCommandeTrait;


class EtatCommandeController extends Controller
{
    use EtatCommandeTrait;

    function __construct()
    {
         $this->middleware('permission:etat_commande-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etatcommande = $this->getDefaultObject(new EtatCommande());

        return view('etatcommandes.create')
          ->with('etatcommande', $etatcommande);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtatCommandeCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New EtatCommande
        $etatcommande = EtatCommande::create($formInput);
        //$this->unsetDefault($etatcommande);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function show(EtatCommande $etatcommande)
    {
        $etatcommande = EtatCommande::with(['statut'])->where('id', $etatcommande->id)->first();
        return view('etatcommandes.show', ['etatcommande' => $etatcommande]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function edit(EtatCommande $etatcommande)
    {
        $selectedtags = $this->getTags($etatcommande->tags);

        return view('etatcommandes.edit')
          ->with('selectedtags', $selectedtags)
          ->with('etatcommande', $etatcommande);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function update(EtatCommandeEditRequest $request, EtatCommande $etatcommande)
    {
        $formInput = $this->formatRequestInput($request);

        $etatcommande->fill($formInput); // $request->input()
        $etatcommande->save();
        //$this->unsetDefault($etatcommande);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EtatCommande  $etatCommande
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtatCommande $etatcommande)
    {
        $etatcommande->delete();
        //$this->unsetDefault($etatcommande);

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Etat Commande'] ));

        return redirect()->action('ParametreController@index', ['active_tab' => 'etatcommande']);
    }
}
