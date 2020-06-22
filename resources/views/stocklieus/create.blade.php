@extends('layouts.app')

@section('page')
  Ajouter Un Lieu
@endsection

@section('content')
<div class="col">
<form action="{{ route('stocklieus.store') }}" method="POST" enctype="multipart/form-data">
    @include('stocklieus.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            @can('stock_lieu-create')
            <button type="submit" class="btn btn-primary">Valider</button>
            @endcan
        </div>
        <div class="col-sm-3">
            <a href="{{ route('stocklieus.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
@endsection
