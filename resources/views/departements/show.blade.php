@extends('layouts.app_show', \App\Departement::view_attributes_show($departement))

@section('show_details')

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $departement->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $departement->intitule }}</dd>

        <dt class="col-sm-3">Chemin complet</dt>
        <dd class="col-sm-9">{{ $departement->chemin_complet }}</dd>

        <dt class="col-sm-3">Département Parent</dt>
        <dd class="col-sm-9">{{ $departement->parent ? $departement->parent->chemin_complet : '' }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $departement->employeResponsable ? $departement->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Type</dt>
        <dd class="col-sm-9">{{ $departement->typedepartement->intitule }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">
          <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $departement->statut->code == 'actif' ? 'checked' : '' }}>
        </dd>

        <dt class="col-sm-3">Créé le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($departement->created_at)) }}</dd>

        <dt class="col-sm-3">Modifié le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($departement->updated_at)) }}</dd>

        @include('recyclebin._details', ['currval' => $departement])
        </dl>

      </div>
    </div>
  </div>


     <div class="col-lg-6">
      <div class="card m-b-30">
      <div class="card-body">

        @include('affectations.liste', ['type_affectation_tag' => 'Departement', 'elem' => $departement, 'affectations' => $departement->affectations])

      </div>
    </div>
  </div>


@endsection
