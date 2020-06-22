@extends('layouts.app_show',[
  'title' => 'zone',
  'model' => $zone,
  'modelname' => $zone->nom,
  'modeltype' => 'de la zone',
  'index_route' => 'ZoneController@index',
  'store_route' => 'ZoneController@store',
  'show_route' => 'ZoneController@show',
  'edit_route' => 'ZoneController@edit',
  'destroy_route' => 'ZoneController@destroy',
  'breadcrumb_title' => 'zones.show',
  'breadcrumb_param' => $zone->id,
  'canlist' => 'zone-list',
  'cancreate' => 'zone-create',
  'canedit' => 'zone-edit',
  'candelete' => 'zone-delete'
])

@section('show_details') 
<div class="row">   
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Détails</h4>

        <p class="text-muted m-b-30 font-14">Détails de la Zone <code class="highlighter-rouge"><strong>{{ $zone->intitulé }}</strong></code>.</p>

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
        <dd class="col-sm-9">{{ $zone->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $zone->intitule }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $zone->employeResponsable ? $zone->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $zone->statut->libelle }}</dd>
       <dt class="col-sm-3">Créé le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($zone->created_at)) }}</dd>
        <dt class="col-sm-3">Modifié le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($zone->updated_at)) }}</dd>

        @include('recyclebin._details', ['currval' => $role])
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