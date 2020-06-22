<?php

namespace App\Http\Controllers;

use App\TypeDepartement;
use App\Statut;

use Illuminate\Http\Request;
use App\Http\Requests\TypeDepartementRequest;
use App\Http\Requests\TypeDepartementCreateRequest;
use App\Http\Requests\TypeDepartementEditRequest;

use App\Traits\TypeDepartementTrait;


class TypeDepartementController extends Controller
{
    use TypeDepartementTrait;

    function __construct()
    {
         $this->middleware('permission:type_departement-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->redirectToParametre();
    }

    private function redirectToParametre(){
        return redirect()->action('ParametreController@index', ['active_tab' => 'typedepartement']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typedepartement = $this->getDefaultObject(new TypeDepartement());
        return view('typedepartements.create')
          ->with('typedepartement', $typedepartement);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeDepartementCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New TypeDepartement
        $typedepartement = TypeDepartement::create($formInput);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDepartement $typedepartement)
    {
        $typedepartement = TypeDepartement::with(['statut'])->where('id', $typedepartement->id)->first();
        return view('typedepartements.show', ['typedepartement' => $typedepartement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDepartement $typedepartement)
    {
        $selectedtags = $this->getTags($typedepartement->tags);

        return view('typedepartements.edit')
          ->with('selectedtags', $selectedtags)
          ->with('typedepartement', $typedepartement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function update(TypeDepartementEditRequest $request, TypeDepartement $typedepartement)
    {
        $formInput = $this->formatRequestInput($request);

        $typedepartement->fill($formInput); // $request->input()
        $typedepartement->save();

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeDepartement  $typedepartement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDepartement $typedepartement)
    {
        $typedepartement->delete();

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }
}
