@extends('layouts.app')

@section('page')
  Détails Lieu
@endsection

@section('content')
    <dl class="row">  
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $stocklieu->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $stocklieu->nom }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $stocklieu->statut->libelle }}</dd>
    </dl>
@endsection