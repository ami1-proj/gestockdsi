<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Employe;
use App\Phonenum;
use App\Fournisseur;
use App\Traits\PhonenumTrait;

class PhonenumController extends Controller
{
    use PhonenumTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonenum  $phonenum
     * @return \Illuminate\Http\Response
     */
    public function show(Phonenum $phonenum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonenum  $phonenum
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonenum $phonenum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonenum  $phonenum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phonenum $phonenum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonenum  $phonenum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonenum $phonenum)
    {
        //
    }

    public function storeelem(Request $request, $elem_type, $elem_id)
    {
        $request->validate([
          'nouveau_phone' => 'required|numeric',
        ]);

        $formInput = $request->all();

        $this->createNewPhonenum($formInput['nouveau_phone'], $elem_type, $elem_id);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => $elem_type . ' phonenums'] ));

        return redirect()->action('PhonenumController@editelem', [$elem_type,$elem_id]);
    }

    public function editelem($elem_type, $elem_id)
    {
        if ($elem_type == 'employe') {
            $elem_arr = [];
            $elem_arr['type'] = $elem_type;
            $elem_arr['id'] = $elem_id;
            $elem_arr['text'] = 'Gestion des Numéros de Téléphone de l’Employé';

            $employe = Employe::where('id', $elem_id)->first();

            $elem_arr['display'] = $employe->nom_complet;
            $elem_arr['breadcrumb'] = 'employes.phonenums';
            $elem_arr['breadcrumb_param'] = $elem_id;

            $elem_arr['edit_controller'] = 'EmployeController@edit';
            $phonenums = $employe->phonenums;
        } else {
            $elem_arr = [];
            $elem_arr['type'] = $elem_type;
            $elem_arr['id'] = $elem_id;
            $elem_arr['text'] = 'Gestion des Numéros de Téléphone du Fournisseur ';

            $fournisseur = Fournisseur::where('id', $elem_id)->first();

            $elem_arr['display'] = $fournisseur->raison_sociale;
            $elem_arr['breadcrumb'] = 'fournisseurs.phonenums';
            $elem_arr['breadcrumb_param'] = $elem_id;

            $elem_arr['edit_controller'] = 'FournisseurController@edit';
            $phonenums = $fournisseur->phonenums;
        }

        //dd($phonenums[1]->pivot->rang);

        return view('phonenums.editelem')
          ->with('phonenums', $phonenums)
          ->with('elem_arr', $elem_arr);
    }

    public function updateelem(Request $request, $elem_type, $elem_id, $phonenum_id)
    {
        //dd($request,$elem_type,$elem_id,$phonenum_id);
        if ($request['action'] == 'up') {
            $this->moveUpPhonenum($phonenum_id, $elem_type, $elem_id);
        } elseif ($request['action'] == 'down') {
            $this->moveDownPhonenum($phonenum_id, $elem_type, $elem_id);
        } else {
            $this->deletePhonenum($phonenum_id, $elem_type, $elem_id);
        }

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => $elem_type . ' phonenums'] ));

        return redirect()->action('PhonenumController@editelem', [$elem_type,$elem_id]);
    }
}
