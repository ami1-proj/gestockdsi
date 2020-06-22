<?php      
  
namespace App\Http\Controllers;

use App\Traits\ServiceTrait;

use Illuminate\Support\Facades\DB;    
   
use App\Service;
use App\Employe;
use App\Article;   
use App\Division;   

use App\SituationArticle;

use Illuminate\Http\Request; 
use App\Http\Requests\ServiceRequest;
class ServiceController extends Controller
{  
    use ServiceTrait;
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
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
        $services = Service::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('services.index', compact('services', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $divisions = Division::get()->pluck('intitule', 'id');
        $employes = Employe::get()->pluck('nom_complet', 'id');

        $selectedtags = $this->getTags("r");
        return view('services.create')
          ->with('statuts', $statuts)
          ->with('employes', $employes)
          ->with('selectedtags', $selectedtags)
          ->with('divisions', $divisions)
          ->with('service', (new Service()));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request )
    {
        $formInput = $request->all();
        

        // Store the New service
        $service = Service::create($formInput); 

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelSaved', ['modelname' => 'Service'] ));

        return redirect()->action('ServiceController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $service = Service::with('statut')->where('id', $service->id)->first();
        

         return view('services.show', ['service' => $service, 'affectations' => $service->affectations, 'elem_id' => $service->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $divisions = Division::get()->pluck('intitule', 'id');
        $selectedtags = $this->getTags($service->tags);
        $employes = Employe::get()->pluck('nom_complet', 'id');
        return view('services.edit')
          ->with('statuts', $statuts)
          ->with('selectedtags', $selectedtags)
          ->with('employes', $employes)
          ->with('divisions', $divisions)
          ->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
         //$formInput = $request->all();
        //dd($request->input());
        $service->fill($request->input());
        $service->save();

        // Sessions Message
        $request->session()->flash('msg',__('messages.modelUpdated', ['modelname' => 'Service'] ));

        return redirect()->action('ServiceController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        // Sessions Message
        session()->flash('msg',__('messages.modelDeleted', ['modelname' => 'Service'] ));

        return redirect()->action('ServiceController@index');
    }

     //affectation 
     public function affectation(Service $service)
    {
        $service = Service::with('statut')->where('id', $service->id)->first();
        $articles_disponibles = Article::where('situation_article_id', 1)->where('etat_article_id', '!=', 3)->get()->pluck('reference_complete', 'id');
        $articles_affectes = $service->articles()->whereNull('fin_affectation')->get()->pluck('reference_complete', 'id');

        return view('services.affectation')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('articles_affectes', $articles_affectes)
          ->with('service', $service);
    } 
   
   //action
   
   public function affectationupdate(Request $request, Service $service)
    {
        $formInput = $request->all();
        $situation_article_service = SituationArticle::where('id', 3)->first();
        $situation_article_stock = SituationArticle::where('id', 1)->first();

        if(array_key_exists('articles_disponibles', $formInput)) {  
            
            foreach ($formInput['articles_disponibles'] as $article_id) {
                $this->AffecterArticle($article_id, $situation_article_service->id, $service->id);
            }
            // Sessions Message
            $request->session()->flash('msg',__('messages.affectationDone', ['modelname' => 'Service'] ));
        }   

        if(array_key_exists('articles_affectes', $formInput)) {
            // article(s) du service à désaffecter
            foreach ($formInput['articles_affectes'] as $article_id) {
                $this->AffecterArticle($article_id, $situation_article_stock->id, 1);
            }

            // Sessions Message
            $request->session()->flash('msg',__('messages.desaffectationDone', ['modelname' => 'Service'] ));
        }

        //dd($formInput);

        return redirect()->action('ServiceController@affectation', ['service' => $service->id]);
    }

}
