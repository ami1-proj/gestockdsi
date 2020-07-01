<?php

namespace App\Http\Controllers;
use App\Affectation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Article;
use Illuminate\Http\Request;

use App\Traits\ArticleTrait;
use App\TypeMouvement;
use App\MarqueArticle;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleEditRequest;
use App\Http\Requests\ArticleCreateRequest;
use App\TypeAffectation;
use App\EtatArticle;
use App\Fournisseur;
use App\TypeArticle;


class ArticleController extends Controller
{
    use ArticleTrait;

    function __construct()
    {
         $this->middleware('permission:article-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'reference'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');

        $articles = Article::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        //dd($articles);

        return view('articles.index', compact('articles', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_mouvements = DB::table('type_mouvements')->get()->pluck('libelle', 'id');
        $type_affectations = DB::table('type_affectations')->get()->pluck('libelle', 'id');
        $type_articles = DB::table('type_articles')->get()->pluck('libelle', 'id');
        $fournisseurs = DB::table('fournisseurs')->get()->pluck('raison_sociale', 'id');
        $marque_articles = DB::table('marque_articles')->get()->pluck('nom', 'id');
        $selectedtags = $this->getTags("r");
        $etat_articles = DB::table('etat_articles')->get()->pluck('libelle', 'id');

        $article = $this->getDefaultObject(new Article());

        $nowdate = Carbon::now();

        return view('articles.create')
          ->with('selectedtags', $selectedtags)
          ->with('type_mouvements', $type_mouvements)
          ->with('type_affectations', $type_affectations)
          ->with('type_articles', $type_articles)
          ->with('fournisseurs', $fournisseurs)
          ->with('marque_articles', $marque_articles)
          ->with('etat_articles', $etat_articles)
          ->with('nowdate', $nowdate)

          ->with('article', $article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New article
        $fournisseur = Article::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Article'] ));

        return redirect()->action('ArticleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = Article::with('statut')->where('id', $article->id)->first();
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $type_mouvements = TypeMouvement::get()->pluck('libelle', 'id');//DB::table('type_mouvements')->get()->pluck('libelle', 'id');
        $type_affectations = TypeAffectation::get()->pluck('libelle', 'id');//DB::table('type_affectations')->get()->pluck('libelle', 'id');
        $type_articles = TypeArticle::get()->pluck('libelle', 'id');//DB::table('type_articles')->get()->pluck('libelle', 'id');
        $fournisseurs = Fournisseur::get()->pluck('nom', 'id');//DB::table('fournisseurs')->get()->pluck('nom', 'id');
        $marque_articles = MarqueArticle::get()->pluck('nom', 'id');//DB::table('marque_articles')->get()->pluck('nom', 'id');
        $etat_articles = EtatArticle::get()->pluck('libelle', 'id');//DB::table('etat_articles')->get()->pluck('libelle', 'id');

        $selectedtags = $this->getTags($article->tags);

        return view('articles.edit')

          ->with('type_mouvements', $type_mouvements)
          ->with('type_affectations', $type_affectations)
          ->with('type_articles', $type_articles)
          ->with('fournisseurs', $fournisseurs)
          ->with('marque_articles', $marque_articles)
          ->with('etat_articles', $etat_articles)
          ->with('selectedtags', $selectedtags)
          ->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleEditRequest $request, Article $article)
    {
        $formInput = $this->formatRequestInput($request);
        $article->fill($formInput);

        $article->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Article'] ));

        return redirect()->action('ArticleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Article'] ));
        //$article->addToRecycleBin();

        return redirect()->action('ArticleController@index');
    }


    public function affectation($situation_id, $elem_id)
    {
        $articles_disponibles = Article::where('situation_article_id', 1)->where('etat_article_id', '!=', 3)->get()->pluck('reference_complete', 'id');
        $elem_arr = $this->getElemArray($situation_id, $elem_id);
        $articles_affectes = $elem_arr['elem']->articles()->whereNull($elem_arr['colonne_fin_affectation'])->get()->pluck('reference_complete', 'id');
        $controller = $elem_arr['controller'];

        return view('articles.affectation')
          ->with('articles_disponibles', $articles_disponibles)
          ->with('articles_affectes', $articles_affectes)
          ->with('situation_id', $situation_id)
          ->with('controller', $controller)
          ->with('elem_arr', $elem_arr);
    }

    public function affectationupdate(Request $request, $situation_id, $elem_id)
    {
        $formInput = $request->all();
        $situation_article_stock = SituationArticle::where('id', 1)->first();

        if(array_key_exists('articles_disponibles', $formInput)) {
            // article(s) disponible(s) à affecter
            foreach ($formInput['articles_disponibles'] as $article_id) {
                $this->AffecterArticle($article_id, $situation_id, $elem_id);
            }
            // Sessions Message
            $request->session()->flash('msg_success',__('messages.affectationDone', ['modelname' => 'Employe'] ));
        }

        if(array_key_exists('articles_affectes', $formInput)) {
            // article(s) de l'employe à désaffecter
            foreach ($formInput['articles_affectes'] as $article_id) {
                $this->AffecterArticle($article_id, $situation_article_stock->id, $elem_id);
            }

            // Sessions Message
            $request->session()->flash('msg_success',__('messages.desaffectationDone', ['modelname' => 'Employe'] ));
        }

        //dd($formInput);

        return redirect()->action('ArticleController@affectation', [$situation_id, $elem_id]);
    }

    public function selectmorearticles(Request $request)
    {
        $search = $request->get('search');
        $affectationid = $request->get('affectationid');

        if (! $affectationid) {
            $data = Article::disponibles()
                ->select(['id', 'reference_complete'])
                ->where('reference_complete', 'like', '%' . $search . '%')
                ->orderBy('reference_complete')->paginate(5);
        } else {
            $affectation = Affectation::where('id',$affectationid)->first();
            $articles_affectation_ids = $affectation->articles()->pluck('id', 'id')->toArray();
            $articles_affectation = Article::select(['id', 'reference_complete'])
                ->whereIn('id', $articles_affectation_ids)
                ->where('reference_complete', 'like', '%' . $search . '%')
                ->orderBy('reference_complete');

            $data = Article::disponibles()
                ->select(['id', 'reference_complete'])
                ->where('reference_complete', 'like', '%' . $search . '%')
                ->union($articles_affectation)
                ->orderBy('reference_complete')->paginate(5);
        }

        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }
}
