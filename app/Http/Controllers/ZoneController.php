<?php
  
namespace App\Http\Controllers;
use App\Traits\ZoneTrait;
use Illuminate\Support\Facades\DB;    

use App\Zone;
use App\Employe; 
use App\Article;   

use Illuminate\Http\Request;  
use App\Http\Requests\ZoneRequest;

class ZoneController extends Controller
{
    use ZoneTrait;  
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
        $zones = Zone::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        //dd($zones);

        return view('zones.index', compact('zones', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        $selectedtags = $this->getTags("r");
        return view('zones.create')
          ->with('statuts', $statuts)
          ->with('employes', $employes)
          ->with('selectedtags', $selectedtags)

          ->with('zone', (new Zone()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        $formInput = $request->all();
        

        // Store the New zone
        $zone = zone::create($formInput); 

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Zone'] ));

        return redirect()->action('ZoneController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        $zone = Zone::with('statut')->where('id', $zone->id)->first();

        return view('zones.show', ['zone' => $zone, 'affectations' => $zone->affectations, 'elem_id' => $zone->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        $selectedtags = $this->getTags($zone->tags);
        return view('zones.edit')
          ->with('statuts', $statuts)
          ->with('selectedtags', $selectedtags)
          ->with('employes', $employes)
          ->with('zone', $zone);
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        //$formInput = $request->all();
        //dd($request->input());
        $zone->fill($request->input());
        $zone->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'Zone'] ));

        return redirect()->action('ZoneController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Zone'] ));

        return redirect()->action('ZoneController@index');
    }
}