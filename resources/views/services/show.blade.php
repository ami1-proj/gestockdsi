@extends('layouts.app_show',[
  'title' => 'services',
  'model' => $service,
  'modelname' => $service->nom,
  'modeltype' => 'du service',
  'index_route' => 'ServiceController@index',
  'store_route' => 'ServiceController@store',
  'show_route' => 'ServiceController@show',
  'edit_route' => 'ServiceController@edit',
  'destroy_route' => 'ServiceController@destroy',
  'breadcrumb_title' => 'services.show',
  'breadcrumb_param' => $service->id,
  'canlist' => 'service-list',
  'cancreate' => 'service-create',
  'canedit' => 'service-edit',
  'candelete' => 'service-delete'
])

@section('show_details')

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $service->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $service->intitule }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $service->employeResponsable ? $service->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $service->division->intitule }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $service->statut->libelle }}</dd>
     <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($service->created_at)) }}</dd>
            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($service->updated_at)) }}</dd>

            @include('recyclebin._details', ['currval' => $service])
        </dl>

      </div>
    </div>
  </div>


     <div class="col-lg-6">
      <div class="card m-b-30">
      <div class="card-body">

        @include('affectations.liste', ['type_affectation_tag' => 'Service', 'elem_id' => $service->id])

      </div>
    </div>
  </div>


@endsection
