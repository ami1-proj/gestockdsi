<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Adresseemail;
use App\Employe;
use App\Fournisseur;
use App\Traits\AdresseemailTrait;

class AdresseemailController extends Controller
{
    use AdresseemailTrait;
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
     * @param  \App\Adresseemail  $adresseemail
     * @return \Illuminate\Http\Response
     */
    public function show(Adresseemail $adresseemail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adresseemail  $adresseemail
     * @return \Illuminate\Http\Response
     */
    public function edit(Adresseemail $adresseemail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adresseemail  $adresseemail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adresseemail $adresseemail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adresseemail  $adresseemail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adresseemail $adresseemail)
    {
        //
    }

    public function storeelem(Request $request, $elem_type, $elem_id)
    {
        $request->validate([
          'nouveau_email' => 'required|email',
        ]);

        $formInput = $request->all();

        $this->createNewAdresseemail($formInput['nouveau_email'], $elem_type, $elem_id);

        // Sessions Message
        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => $elem_type . ' emails'] ));

        return redirect()->action('AdresseemailController@editelem', [$elem_type,$elem_id]);
    }

    public function editelem($elem_type, $elem_id)
    {
        if ($elem_type == 'employe') {
            $elem_arr = [];
            $elem_arr['type'] = $elem_type;
            $elem_arr['id'] = $elem_id;
            $elem_arr['text'] = 'Gestion des Adresses E-mail de l’Employé';

            $employe = Employe::where('id', $elem_id)->first();

            $elem_arr['display'] = $employe->nom_complet;
            $elem_arr['breadcrumb'] = 'employes.emails';
            $elem_arr['breadcrumb_param'] = $elem_id;

            $elem_arr['edit_controller'] = 'EmployeController@edit';
            $adresseemails = $employe->adresseemails;
        } else {
            $elem_arr = [];
            $elem_arr['type'] = $elem_type;
            $elem_arr['id'] = $elem_id;
            $elem_arr['text'] = 'Gestion des Adresses E-mail du Fournisseur ';

            $fournisseur = Fournisseur::where('id', $elem_id)->first();

            $elem_arr['display'] = $fournisseur->raison_sociale;
            $elem_arr['breadcrumb'] = 'fournisseurs.emails';
            $elem_arr['breadcrumb_param'] = $elem_id;

            $elem_arr['edit_controller'] = 'FournisseurController@edit';
            $adresseemails = $fournisseur->adresseemails;
        }

        //dd($adresseemails[1]->pivot->rang);

        return view('adresseemails.editelem')
          ->with('adresseemails', $adresseemails)
          ->with('elem_arr', $elem_arr);
    }

    public function updateelem(Request $request, $elem_type, $elem_id, $adresseemail_id)
    {
        //dd($request,$elem_type,$elem_id,$adresseemail_id);
        if ($request['action'] == 'up') {
            $this->moveUpAdresseemail($adresseemail_id, $elem_type, $elem_id);
            $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => $elem_type . ' emails'] ));
        } elseif ($request['action'] == 'down') {
            $this->moveDownAdresseemail($adresseemail_id, $elem_type, $elem_id);
            $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => $elem_type . ' emails'] ));
        } else {
            $del_rslt = $this->deleteAdresseemail($adresseemail_id, $elem_type, $elem_id);
            if ($del_rslt == 1) {
              $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => $elem_type . ' emails'] ));
            } elseif ($del_rslt == -1) {
              $request->session()->flash('msg_success',__('messages.modelCannotDelTheLast', ['modelname' => $elem_type . ' emails'] ));
            } else {
              $request->session()->flash('Nothing done!');
            }
        }

        return redirect()->action('AdresseemailController@editelem', [$elem_type,$elem_id]);
    }
}
