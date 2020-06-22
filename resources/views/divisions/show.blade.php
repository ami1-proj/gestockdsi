@extends('layouts.app_show',[
  'title' => 'divisions',
  'model' => $division,
  'modelname' => $division->nom,
  'modeltype' => 'de la division',
  'index_route' => 'DivisionController@index',
  'store_route' => 'DivisionController@store',
  'show_route' => 'DivisionController@show',
  'edit_route' => 'DivisionController@edit',
  'destroy_route' => 'DivisionController@destroy',
  'breadcrumb_title' => 'divisions.show',
  'breadcrumb_param' => $division->id,
  'canlist' => 'division-list',
  'cancreate' => 'division-create',
  'canedit' => 'division-edit',
  'candelete' => 'division-delete'
])

@section('show_details')

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">


    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $division->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $division->intitule }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $division->divisionResponsable ? $division->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $division->statut->libelle }}</dd>
       <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($division->created_at)) }}</dd>
            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($division->updated_at)) }}</dd>

            @include('recyclebin._details', ['currval' => $division])
        </dl>

      </div>
    </div>
  </div>




  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        @include('affectations.liste', ['type_affectation_tag' => 'Division', 'elem_id' => $division->id])

      </div>
    </div>
  </div>
</div>
@endsection
