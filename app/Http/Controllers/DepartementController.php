<?php

namespace App\Http\Controllers;

use App\Departement;
use App\Employe;
use App\TypeDepartement;

use Illuminate\Http\Request;
use App\Http\Requests\DepartementRequest;
use App\Http\Requests\DepartementCreateRequest;
use App\Http\Requests\DepartementEditRequest;

use App\Traits\DepartementTrait;

use Illuminate\Support\Facades\DB;


class DepartementController extends Controller
{
    use DepartementTrait;

    function __construct()
    {
         $this->middleware('permission:departement-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        $recherche_cols = ['id', 'intitule', 'departement parent'];
        $recherche_cols_val = ['id' => 'id', 'intitule' => 'intitule', 'departement parent' => 'departement_parent_id'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $recherche_cols_val[$request->query('sortBy')];
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $departements = Departement::search($q, 'departement')->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('departements.index', compact('departements', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = Departement::get()->pluck('chemin_complet', 'id');
        $typedepartements = TypeDepartement::get()->pluck('intitule', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');

        $departement = $this->getDefaultObject(new Departement());

        $selectedtags = $this->getTags("r");
        return view('departements.create')
          ->with('employes', $employes)
          ->with('selectedtags', $selectedtags)
          ->with('typedepartements', $typedepartements)
          ->with('departements', $departements)
          ->with('departement', $departement);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartementCreateRequest $request )
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New departement
        $departement = Departement::create($formInput);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Departement'] ));

        return redirect()->action('DepartementController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        $departement = Departement::with('statut')->where('id', $departement->id)->first();

        //dd('relations', $departement->relationships(), 'sub children', $departement->subChildrenRelations());

        return view('departements.show', ['departement' => $departement, 'affectations' => $departement->affectations, 'elem_id' => $departement->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $departements = Departement::get()->pluck('chemin_complet', 'id');
        $typedepartements = TypeDepartement::get()->pluck('intitule', 'id');
        $selectedtags = $this->getTags($departement->tags);
        $employes = Employe::get()->pluck('nom_complet', 'id');

        return view('departements.edit')
          ->with('statuts', $statuts)
          ->with('selectedtags', $selectedtags)
          ->with('employes', $employes)
          ->with('typedepartements', $typedepartements)
          ->with('departements', $departements)
          ->with('departement', $departement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(DepartementEditRequest $request, Departement $departement)
    {
        $formInput = $this->formatRequestInput($request);

        $departement->fill($formInput);
        $departement->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Departement'] ));

        return redirect()->action('DepartementController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();

        // Sessions Message
        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Departement'] ));

        return redirect()->action('DepartementController@index');
    }

     //affectation
     public function affectation(Departement $departement)
    {
        $departement = Departement::with('statut')->where('id', $departement->id)->first();
        $articles_disponibles = Article::where('situation_article_id', 1)->where('etat_article_id', '!=', 3)->get()->pluck('reference_complete', 'id');
        $articles_affectes = $departement->articles()->whereNull('fin_affectation')->get()->pluck('reference_complete', 'id');

        return view('departements.affectation')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('articles_affectes', $articles_affectes)
          ->with('departement', $departement);
    }

   //action

   public function affectationupdate(Request $request, Departement $departement)
    {
        $formInput = $request->all();
        $situation_article_departement = SituationArticle::where('id', 3)->first();
        $situation_article_stock = SituationArticle::where('id', 1)->first();

        if(array_key_exists('articles_disponibles', $formInput)) {

            foreach ($formInput['articles_disponibles'] as $article_id) {
                $this->AffecterArticle($article_id, $situation_article_departement->id, $departement->id);
            }
            // Sessions Message
            $request->session()->flash('msg_success',__('messages.affectationDone', ['modelname' => 'Departement'] ));
        }

        if(array_key_exists('articles_affectes', $formInput)) {
            // article(s) du departement à désaffecter
            foreach ($formInput['articles_affectes'] as $article_id) {
                $this->AffecterArticle($article_id, $situation_article_stock->id, 1);
            }

            // Sessions Message
            $request->session()->flash('msg_success',__('messages.desaffectationDone', ['modelname' => 'Departement'] ));
        }

        //dd($formInput);

        return redirect()->action('DepartementController@affectation', ['departement' => $departement->id]);
    }

    public function softget(Request $request)
    {
        $data = [];

          if($request->has('q')){
              $search = $request->q;
              $data = DB::table("departements")
              		->select("id","chemin_complet")
              		->where('intitule','LIKE',"%$search%")
                  ->orWhere('chemin_complet', 'LIKE',"%$search%")
              		->get();
          }

          return response()->json($data);
    }
}
