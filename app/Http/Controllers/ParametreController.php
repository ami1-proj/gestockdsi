<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statut;
use App\EtatArticle;
use App\EtatCommande;
use App\TypeMouvement;
use App\TypeAffectation;
use App\TypeDepartement;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statuts = Statut::all();
        $etatarticles = EtatArticle::all();
        $typeaffectations = TypeAffectation::with('statut')->get();
        $typemouvements = TypeMouvement::with('statut')->get();
        $etatcommandes = EtatCommande::with('statut')->get();
        $typedepartements = TypeDepartement::with('statut')->get();

        if ($request->has('active_tab')) {$active_tab = $request['active_tab'];} else {$active_tab = 'statut';};

        return view('parametres.index')
          ->with('active_tab', $active_tab)
          ->with('statuts', $statuts)
          ->with('etatarticles', $etatarticles)
          ->with('typeaffectations', $typeaffectations)
          ->with('typemouvements', $typemouvements)
          ->with('etatcommandes', $etatcommandes)
          ->with('typedepartements', $typedepartements)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
