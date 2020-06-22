  @extends('layouts.app')

@section('page')
  Détails Stock
@endsection

@section('content')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $stock->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $stock->intitule }}</dd>

        <dt class="col-sm-3">Lieu</dt>
        <dd class="col-sm-9">{{ $stock->stock_lieu->nom}}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">
          <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $stocks->statut->code == 'actif' ? 'checked' : '' }}>
        </dd>
    </dl>
@endsection
