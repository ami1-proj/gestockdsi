@extends('layouts.app_show',[
  'title' => ' agence',
  'model' => $agence,
  'modelname' => $agence->nom,
  'modeltype' => 'de la agence',
  'index_route' => 'AgenceController@index',
  'store_route' => 'AgenceController@store',
  'show_route' => 'AgenceController@show',
  'edit_route' => 'AgenceController@edit',
  'destroy_route' => 'AgenceController@destroy',
  'breadcrumb_title' => 'agences.show',
  'breadcrumb_param' => $agence->id,
  'canlist' => 'agence-list',
  'cancreate' => 'agence-create',
  'canedit' => 'agence-edit',
  'candelete' => 'agence-delete'
])

@section('show_details') 

<div class="row">   
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Détails</h4>

        <p class="text-muted m-b-30 font-14">Détails de la Agence <code class="highlighter-rouge"><strong>{{ $agence->intitule }}</strong></code>.</p>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">


    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $agence->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $agence->intitule }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $agence->agenceResponsable ? $agence->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $agence->statut->libelle }}</dd>
       <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($agence->created_at)) }}</dd>
            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($agence->updated_at)) }}</dd>

            @include('recyclebin._details', ['currval' => $agence])
        </dl>

      </div>
    </div>
  </div>


    

  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">  

        @include('affectations.liste')

      </div>
    </div>
  </div>
</div>
@endsection