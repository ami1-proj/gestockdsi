@extends('layouts.app_show',[
  'title' => ' direction',
  'model' => $direction,
  'modelname' => $direction->nom,
  'modeltype' => 'de la direction',
  'index_route' => 'DirectionController@index',
  'store_route' => 'DirectionController@store',
  'show_route' => 'DirectionController@show',
  'edit_route' => 'DirectionController@edit',
  'destroy_route' => 'DirectionController@destroy',
  'breadcrumb_title' => 'directions.show',
  'breadcrumb_param' => $direction->id,
  'canlist' => 'direction-list',
  'cancreate' => 'direction-create',
  'canedit' => 'direction-edit',
  'candelete' => 'direction-delete'
])

@section('show_details')

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $direction->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $direction->intitule }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $direction->employeResponsable ? $direction->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $direction->statut->libelle }}</dd>
       <dt class="col-sm-3">Créé le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($direction->created_at)) }}</dd>
        <dt class="col-sm-3">Modifié le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($direction->updated_at)) }}</dd>

        @include('recyclebin._details', ['currval' => $direction])
        </dl>

      </div>
    </div>
  </div>


  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        @include('affectations.liste', ['type_affectation_tag' => 'Direction', 'elem_id' => $direction->id])

      </div>
    </div>
  </div>
</div>
@endsection
