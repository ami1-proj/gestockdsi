<?php

namespace App\Http\Controllers;

use App\TypeAffectation;
use App\Statut;

use Illuminate\Http\Request;
use App\Http\Requests\TypeAffectationRequest;
use App\Http\Requests\TypeAffectationCreateRequest;
use App\Http\Requests\TypeAffectationEditRequest;

use App\Traits\TypeAffectationTrait;


class TypeAffectationController extends Controller
{
    use TypeAffectationTrait;

    function __construct()
    {
         $this->middleware('permission:type_affectation-delete', ['only' => ['destroy']]);
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
        return redirect()->action('ParametreController@index', ['active_tab' => 'typeaffectation']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeaffectation = $this->getDefaultObject(new TypeAffectation());

        return view('typeaffectations.create')
          ->with('typeaffectation', $typeaffectation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeAffectationCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New TypeAffectation
        $typeaffectation = TypeAffectation::create($formInput);
        //$this->unsetDefault($typeaffectation);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeAffectation  $typeaffectation
     * @return \Illuminate\Http\Response
     */
    public function show(TypeAffectation $typeaffectation)
    {
        $typeaffectation = TypeAffectation::with(['statut'])->where('id', $typeaffectation->id)->first();
        return view('typeaffectations.show', ['typeaffectation' => $typeaffectation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeAffectation  $typeaffectation
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeAffectation $typeaffectation)
    {
        $statuts = Statut::get()->pluck('libelle', 'id');
        $selectedtags = $this->getTags($typeaffectation->tags);

        return view('typeaffectations.edit')
          ->with('selectedtags', $selectedtags)
          ->with('statuts', $statuts)
          ->with('typeaffectation', $typeaffectation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeAffectation  $typeaffectation
     * @return \Illuminate\Http\Response
     */
    public function update(TypeAffectationEditRequest $request, TypeAffectation $typeaffectation)
    {
        $formInput = $this->formatRequestInput($request);

        $typeaffectation->fill($formInput);

        $typeaffectation->save();

        //$this->unsetDefault($typeaffectation);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeAffectation  $typeaffectation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeAffectation $typeaffectation)
    {
        $typeaffectation->delete();
        //$this->unsetDefault($typeaffectation);

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Type Affectation'] ));

        return $this->redirectToParametre();
    }
}
