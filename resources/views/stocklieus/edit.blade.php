  @extends('layouts.app')

@section('page')
  Modifier le Lieu
@endsection

@section('content')
<div class="col">
<form action="{{ route('stocklieus.update', ['stocklieu' => $stockLieu]) }}" method="POST">
    @method('PUT')
    @include('stocklieus.fields')

    <div class="form-group row">
        <div class="col-sm-3">
            @can('stock_lieu-edit')
            <button type="submit" class="btn btn-primary">Modifier</button>
            @endcan
        </div>
        <div class="col-sm-3">
            <a href="{{ route('stocklieus.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
@endsection 