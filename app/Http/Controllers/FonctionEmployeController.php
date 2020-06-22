<?php

namespace App\Http\Controllers;

use App\FonctionEmploye;

use Illuminate\Http\Request;
use App\Http\Requests\FonctionEmployeRequest;
use App\Http\Requests\FonctionEmployeCreateRequest;
use App\Http\Requests\FonctionEmployeEditRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Traits\FonctionEmployeTrait;


class FonctionEmployeController extends Controller
{
    use FonctionEmployeTrait;

    function __construct()
    {
         $this->middleware('permission:fonction_employe-delete', ['only' => ['destroy']]);
    }

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
        $fonctionemployes = FonctionEmploye::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('fonctionemployes.index', compact('fonctionemployes', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fonctionemploye = $this->getDefaultObject(new FonctionEmploye());

        return view('fonctionemployes.create')
          ->with('fonctionemploye', $fonctionemploye);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FonctionEmployeCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);
         // Store the New Etat commande
        $fonctionemploye = FonctionEmploye::create($formInput); // $request->input()

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Fonction'] ));

        return redirect()->action('FonctionEmployeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FonctionEmploye  $fonctionEmploye
     * @return \Illuminate\Http\Response
     */
    public function show(FonctionEmploye $fonctionemploye)
    {
        $fonctionemploye = FonctionEmploye::with('statut')->where('id', $fonctionemploye->id)->first();
        return view('fonctionemployes.show', ['fonctionemploye' => $fonctionemploye]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FonctionEmploye  $fonctionEmploye
     * @return \Illuminate\Http\Response
     */
    public function edit(FonctionEmploye $fonctionemploye)
    {
        return view('fonctionemployes.edit')
          ->with('fonctionemploye', $fonctionemploye);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FonctionEmploye  $fonctionEmploye
     * @return \Illuminate\Http\Response
     */
    public function update(FonctionEmployeEditRequest $request, FonctionEmploye $fonctionemploye)
    {
        $formInput = $this->formatRequestInput($request);
        $fonctionemploye->fill($formInput);
        $fonctionemploye->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Fonction'] ));

        return redirect()->action('FonctionEmployeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FonctionEmploye  $fonctionEmploye
     * @return \Illuminate\Http\Response
     */
    public function destroy(FonctionEmploye $fonctionemploye)
    {
        $fonctionemploye->delete();

        // Sessions Message
        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Fonction'] ));

        return redirect()->action('FonctionEmployeController@index');
    }

    public function softadd(Request $request)
    {
        $rules = [
            'intitule' => 'required|unique:fonction_employes,intitule',
        ];
        $messages = [
            'intitule.unique' => 'Cette fonction existe deja!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);

        $formInput = $request->all();
        $formInput['statut_id'] = Statut::actif()->first()->id;

        $fonctionemploye = FonctionEmploye::create($formInput);

        return response()->json([
            'fail' => false,
            'newdata' => $fonctionemploye->toJson(),
            'redirect_url' => url('employes')
        ]);
    }

    public function softget(Request $request)
    {
        $data = [];

          if($request->has('q')){
              $search = $request->q;
              $data = DB::table("fonction_employes")
              		->select("id","intitule")
              		->where('intitule','LIKE',"%$search%")
              		->get();
          }

          return response()->json($data);
    }
}
