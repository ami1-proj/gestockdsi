<?php

namespace App\Http\Controllers;

use App\TypeMouvement;
use App\Statut;

use Illuminate\Http\Request;
use App\Http\Requests\TypeMouvementRequest;
use App\Http\Requests\TypeMouvementCreateRequest;
use App\Http\Requests\TypeMouvementEditRequest;

use App\Traits\TypeMouvementTrait;


class TypeMouvementController extends Controller
{
    use TypeMouvementTrait;

    function __construct()
    {
         $this->middleware('permission:type_mouvement-delete', ['only' => ['destroy']]);
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
        return redirect()->action('ParametreController@index', ['active_tab' => 'typemouvement']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typemouvement = $this->getDefaultObject(new TypeMouvement());
        return view('typemouvements.create')
          ->with('typemouvement', $typemouvement);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeMouvementCreateRequest $request)
    {
        $formInput = $this->formatRequestInput($request);

        // Store the New TypeMouvement
        $typemouvement = TypeMouvement::create($formInput);
        //$this->unsetDefault($typemouvement);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Type Mouvement'] ));

        return $this->redirectToParametre();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function show(TypeMouvement $typemouvement)
    {
        $typemouvement = TypeMouvement::with(['statut'])->where('id', $typemouvement->id)->first();
        return view('typemouvements.show', ['typemouvement' => $typemouvement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeMouvement $typemouvement)
    {
        $selectedtags = $this->getTags($typemouvement->tags);

        return view('typemouvements.edit')
          ->with('selectedtags', $selectedtags)
          ->with('typemouvement', $typemouvement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function update(TypeMouvementEditRequest $request, TypeMouvement $typemouvement)
    {
        $formInput = $this->formatRequestInput($request);

        $typemouvement->fill($formInput); // $request->input()
        $typemouvement->save();
        //$this->unsetDefault($typemouvement);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Type Mouvement'] ));

        return $this->redirectToParametre();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeMouvement  $typemouvement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeMouvement $typemouvement)
    {
        $typemouvement->delete();
        //$this->unsetDefault($typemouvement);

        session()->flash('msg_success',__('messages.modelDeleted', ['modelname' => 'Type Mouvement'] ));

        return $this->redirectToParametre();
    }
}
