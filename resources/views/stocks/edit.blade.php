@extends('layouts.app')

@section('page')
  Modifier Stocks
@endsection

@section('css')
@include('tags.tags_css')
@endsection
      

@section('content')
<div class="col">   
<form action="{{ route('stocks.update', ['statut' => $statuts]) }}" method="POST">
    @method('PUT')
    @include('stocks.fields')
    @include('tags.tags_control')

    <div class="form-group row">
        <div class="col-sm-3">
            @can('stock-edit')
            <button type="submit" class="btn btn-primary">Modifier</button>
            @endcan
        </div>
        <div class="col-sm-3">
            <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</form>
</div>
@endsection 

@section('js')
    @include('tags.tags_js')
@endsection