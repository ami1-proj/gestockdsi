<?php

namespace App\Http\Controllers;
use App\Traits\DivisionTrait;

use Illuminate\Support\Facades\DB;  

use App\Division;
use App\Employe;
use App\Article;
  
 
use Illuminate\Http\Request;  
use App\Http\Requests\DivisionRequest;
 
class DivisionController extends Controller
{ 
    use DivisionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $recherche_cols = ['id', 'intitule'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');  
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $divisions = Division::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('divisions.index', compact('divisions', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
       $directions = DB::table('directions')->get()->pluck('intitule', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        
        $selectedtags = $this->getTags("r");


        return view('divisions.create')
          ->with('statuts', $statuts)
          ->with('employes', $employes)
          ->with('directions', $directions)
          ->with('selectedtags', $selectedtags)
          ->with('division', (new Division()));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionRequest $request)
    {
         $formInput = $request->all();
        

        // Store the New division
        $division = division::create($formInput); 

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Division'] ));

        return redirect()->action('DivisionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        $division = Division::with('statut')->where('id', $division->id)->first();
        return view('divisions.show', ['division' => $division, 'affectations' => $division->affectations, 'elem_id' => $division->id]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        
       $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
       $directions = DB::table('directions')->get()->pluck('intitule', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        $selectedtags = $this->getTags($division->tags);
        return view('divisions.edit')
          ->with('statuts', $statuts)
          ->with('selectedtags', $selectedtags)
          ->with('employes', $employes)
          ->with('directions', $directions)  
          ->with('division', $division);
          
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
         //$formInput = $request->all();
        //dd($request->input());
        $division->fill($request->input());
        $division->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'division'] ));

        return redirect()->action('DivisionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        
        $division->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Division'] ));

        return redirect()->action('DivisionController@index');

        
    }

}
