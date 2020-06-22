<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Employe;
use App\Departement;
use App\Tag;

use App\Adresseemail;
use App\Phonenum;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeRequest;
use App\Http\Requests\EmployeCreateRequest;
use App\Http\Requests\EmployeEditRequest;

use App\Traits\EmployeTrait;


class EmployeController extends Controller
{
    use EmployeTrait;

    function __construct()
    {
         $this->middleware('permission:employe-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'nom', 'prenom', 'matricule', 'fonction'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $employes = Employe::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        //dd($employes);
        return view('employes.index', compact('employes', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fonctionemployes = DB::table('fonction_employes')->get()->pluck('intitule', 'id');
        $employe = $this->getDefaultObject(new Employe());

        $departements = Departement::get()->pluck('chemin_complet', 'id');

        return view('employes.create')
          ->with('departements', $departements)
          ->with('fonctionemployes', $fonctionemployes)
          ->with('employe', $employe);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeCreateRequest $request)
    {
        $email = '';
        $phone = '';
        $formInput = $this->formatRequestInput($request, $email, $phone);

        // Store the New Employe
        $employe = Employe::create($formInput);
        // Enregistrement et association du nouvel email et du nouveau phone
        $email = $this->createNewAdresseemail($email, 'employe', $employe->id);
        $email = $this->createNewPhonenum($phone, 'employe', $employe->id);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Employe'] ));

        return redirect()->action('EmployeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        // with(['statut','departement','fonction','affectations'])->
        $employe = Employe::where('id', $employe->id)->first();
        //, 'elem_id' => $employe->id
        return view('employes.show', ['employe' => $employe, 'affectations' => $employe->affectations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        $departements = Departement::get()->pluck('chemin_complet', 'id');
        $fonctionemployes = DB::table('fonction_employes')->get()->pluck('intitule', 'id');

        $selectedtags = $this->getTags($employe->tags);

        $data = response()->json(['items' => $selectedtags->toArray()]);

        $employe_phonenums = $employe->phonenums;
        $employe_adresseemails = $employe->adresseemails;

        return view('employes.edit')
          ->with('departements', $departements)
          ->with('fonctionemployes', $fonctionemployes)
          ->with('employe_adresseemails', $employe_adresseemails)
          ->with('employe_phonenums', $employe_phonenums)
          ->with('data', $data)
          ->with('selectedtags', $selectedtags)
          ->with('employe', $employe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeEditRequest $request, Employe $employe)
    {
        $email = '';
        $phone = '';
        $formInput = $this->formatRequestInput($request, $email, $phone);

        $employe->fill($formInput); // $request->input()
        $employe->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Employe'] ));

        return redirect()->action('EmployeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Employe'] ));

        return redirect()->action('EmployeController@index');
    }

    public function softget(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("employes")->select('id', DB::raw('CONCAT(nom," ",prenom) as nom_complet'))
                ->where('nom', 'LIKE', "%$search%")
                ->orWhere('prenom', 'LIKE', "%$search%")
            		->get();
        }

        return response()->json($data);
    }
}
