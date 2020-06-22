<?php
  
namespace App\Http\Controllers;
use App\Traits\DirectionTrait;
use Illuminate\Support\Facades\DB;    

use App\Direction;
use App\Employe; 
use App\Article;   

use Illuminate\Http\Request;  
use App\Http\Requests\DirectionRequest;

class DirectionController extends Controller
{
    use DirectionTrait;  
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
        $directions = Direction::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        //dd($directions);

        return view('directions.index', compact('directions', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
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
        return view('directions.create')
          ->with('statuts', $statuts)
          ->with('employes', $employes)
          ->with('selectedtags', $selectedtags)

          ->with('direction', (new Direction()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectionRequest $request)
    {
        $formInput = $request->all();
        

        // Store the New direction
        $direction = direction::create($formInput); 

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Direction'] ));

        return redirect()->action('DirectionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        $direction = Direction::with('statut')->where('id', $direction->id)->first();

        return view('directions.show', ['direction' => $direction, 'affectations' => $direction->affectations, 'elem_id' => $direction->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function edit(Direction $direction)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');
        $selectedtags = $this->getTags($direction->tags);
        return view('directions.edit')
          ->with('statuts', $statuts)
          ->with('selectedtags', $selectedtags)
          ->with('employes', $employes)
          ->with('direction', $direction);
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direction $direction)
    {
        //$formInput = $request->all();
        //dd($request->input());
        $direction->fill($request->input());
        $direction->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'Direction'] ));

        return redirect()->action('DirectionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direction $direction)
    {
        $direction->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Direction'] ));

        return redirect()->action('DirectionController@index');
    }
}