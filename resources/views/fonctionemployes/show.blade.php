@extends('layouts.app_show', \App\FonctionEmploye::view_attributes_show($fonctionemploye))

@section('show_details')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $fonctionemploye->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $fonctionemploye->intitule }}</dd>

        <dt class="col-sm-3">Description</dt>
        <dd class="col-sm-9">{{ $fonctionemploye->description }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">
          <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $fonctionemploye->statut->code == 'actif' ? 'checked' : '' }}>
        </dd>
    </dl>
@endsection
