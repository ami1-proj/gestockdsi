<?php

namespace App\Http\Controllers;

use App\Statut;

use Illuminate\Http\Request;
use App\Http\Requests\StatutRequest;
use App\Http\Requests\StatutCreateRequest;
use App\Http\Requests\StatutEditRequest;

use Illuminate\Support\Facades\DB;

use App\Traits\StatutTrait;


class StatutController extends Controller
{
    use StatutTrait;

    function __construct()
    {
         $this->middleware('permission:statut-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return $this->redirectToParametre();
    }

    private function redirectToParametre(){
        return redirect()->action('ParametreController@index', ['active_tab' => 'statut']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('statuts.create')
          ->with('statut', (New Statut()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatutCreateRequest $request)
    {
        $formInput = $request->all();
        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        // Store the New Statut
        $statut = Statut::create($formInput);
        //$this->unsetDefault($statut);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Statut'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function show(Statut $statut)
    {
        $statut = Statut::where('id', $statut->id)->first();
        return view('statuts.show', ['statut' => $statut]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function edit(Statut $statut)
    {
        $selectedtags = $this->getTags($statut->tags);

        return view('statuts.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statut', $statut);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function update(StatutEditRequest $request, Statut $statut)
    {
        $formInput = $request->all();

        // Formattage des INPUT de la requete
        $formInput = $this->formatRequestInput($formInput);

        $statut->fill($formInput);

        $statut->save();
        //$this->unsetDefault($statut);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Statut'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statut  $statut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statut $statut)
    {
        $statut->delete();
        //$this->unsetDefault($statut);

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Statut'] ));

        return $this->redirectToParametre();
    }

    public function change(Request $request)
    {
        if ($request->status == 1) {
          $statut = Statut::actif()->first();
        } else {
          $statut = Statut::inactif()->first();
        }
        // $user = User::find($request->user_id);
        // $user->status = $request->status;
        // $user->save();

        $data = DB::table($request->model_table)
            ->where('id',$request->model_id)
            ->update(['statut_id' => $statut->id]);

        return response()->json(['success'=>'Status change successfully.']);
    }
}
