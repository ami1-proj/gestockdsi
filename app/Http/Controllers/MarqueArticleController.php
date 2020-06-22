<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\MarqueArticle;

use Illuminate\Http\Request;
use App\Http\Requests\MarqueArticleRequest;
use App\Http\Requests\MarqueArticleCreateRequest;
use App\Http\Requests\MarqueArticleEditRequest;

use App\Traits\MarqueArticleTrait;


class MarqueArticleController extends Controller
{
    use MarqueArticleTrait;

    function __construct()
    {
         $this->middleware('permission:marque_article-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'nom'];
        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $marquearticles = MarqueArticle::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('marquearticles.index', compact('marquearticles', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuts = DB::table('statuts')->get()->pluck('libelle', 'id');
        $marquearticle = $this->getDefaultObject(new MarqueArticle());

        return view('marquearticles.create')
          ->with('marquearticle', $marquearticle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarqueArticleCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);
         // Store the New Etat commande
        $marquearticle = MarqueArticle::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Marque'] ));

        return redirect()->action('MarqueArticleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function show(MarqueArticle $marquearticle)
    {
        $marquearticle = MarqueArticle::with('statut')->where('id', $marquearticle->id)->first();
        return view('marquearticles.show', ['marquearticle' => $marquearticle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(MarqueArticle $marquearticle)
    {
        return view('marquearticles.edit')
          ->with('marquearticle', $marquearticle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function update(MarqueArticleEditRequest $request, MarqueArticle $marquearticle)
    {
        $formInput = $this->formatRequestInput($request);
        $marquearticle->fill($formInput);
        $marquearticle->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Marque'] ));

        return redirect()->action('MarqueArticleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MarqueArticle  $marqueArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarqueArticle $marquearticle)
    {
        $marquearticle->delete();

        // Sessions Message
        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Marque Article'] ));

        return redirect()->action('MarqueArticleController@index');
    }

    public function softadd(Request $request)
    {
        $rules = [
            'nom' => 'required|unique:marque_articles,nom',
        ];
        $messages = [
            'nom.unique' => 'Cette Marque existe deja!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);

        $formInput = $request->all();
        $formInput['statut_id'] = Statut::actif()->first()->id;

        $marquearticle = MarqueArticle::create($formInput);

        return response()->json([
            'fail' => false,
            'newdata' => $marquearticle->toJson(),
            'redirect_url' => url('articles')
        ]);
    }

    public function softget(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("marque_articles")
            		->select("id","nom")
                ->where('nom', 'LIKE',"%$search%")
            		->get();
        }

        return response()->json($data);
    }
}
