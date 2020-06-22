<?php

namespace App\Http\Controllers;
use App\Traits\AgenceTrait;

use Illuminate\Support\Facades\DB;  

use App\Agence;
use App\Employe;
use App\Article;
  
 
use Illuminate\Http\Request;  
use App\Http\Requests\AgenceRequest;
 
class AgenceController extends Controller
{ 
    use AgenceTrait;
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
        $agences = Agence::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('agences.index', compact('agences', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
       $zones = DB::table('zones')->get()->pluck('intitule', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        
        $selectedtags = $this->getTags("r");


        return view('agences.create')
          ->with('statuts', $statuts)
          ->with('employes', $employes)
          ->with('zones', $zones)
          ->with('selectedtags', $selectedtags)
          ->with('agence', (new Agence()));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgenceRequest $request)
    {
         $formInput = $request->all();
        

        // Store the New agence
        $agence = agence::create($formInput); 

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Agence'] ));

        return redirect()->action('AgenceController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function show(Agence $agence)
    {
        $agence = Agence::with('statut')->where('id', $agence->id)->first();
        return view('agences.show', ['agence' => $agence, 'affectations' => $agence->affectations, 'elem_id' => $agence->id]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function edit(Agence $agence)
    {
        
       $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
       $zones = DB::table('zones')->get()->pluck('intitule', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        $selectedtags = $this->getTags($agence->tags);
        return view('agences.edit')
          ->with('statuts', $statuts)
          ->with('selectedtags', $selectedtags)
          ->with('employes', $employes)
          ->with('zones', $zones)  
          ->with('agence', $agence);
          
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agence $agence)
    {
         //$formInput = $request->all();
        //dd($request->input());
        $agence->fill($request->input());
        $agence->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'agence'] ));

        return redirect()->action('AgenceController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agence  $agence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agence $agence)
    {
        
        $agence->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Agence'] ));

        return redirect()->action('AgenceController@index');

        
    }

}
