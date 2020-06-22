@extends('layouts.app')

@section('page')
  Articles
@endsection

@section('content')

<div class="row">
        @include('layouts.message')
    </div>

    <form action="{{ route('articles.affectationupdate', [$situation_id,$elem_arr['elem']->id]) }}" method="POST">
    @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Affectation</h4>
                        <p class="text-muted m-b-30 font-14">{{ $elem_arr['text'] }}<code class="highlighter-rouge" style=""><strong>{{ $elem_arr['display'] }}</strong></code>.
                        </p>
                    </div>
                </div>
            </div>  
        </div>


        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Articles disponibles</h4>
                        <div class="form-group">
                            <select class="select2 form-control" name="articles_disponibles[]" multiple="multiple" id="articles_disponibles">
                                @foreach($articles_disponibles as $id => $display)
                                    <option value="{{ $id }}">{{ $display }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Articles affectés</h4>
                        <div class="form-group">
                            <select class="select2 form-control" name="articles_affectes[]" multiple="multiple" id="articles_affectes">
                                @foreach($articles_affectes as $id => $display)
                                    <option value="{{ $id }}">{{ $display }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @csrf

    <div class="form-group row">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
        <div class="col-sm-3">
            @if($situation_id == 1)
              <a href="{{ action('StockController@show', [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Retour</a>
            @elseif($situation_id == 2)
              <a href="{{ action('EmployeController@show', [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Retour</a>
            @elseif($situation_id == 3)
              <a href="{{ action('ServiceController@show', [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Retour</a>
            @elseif($situation_id == 4)
              <a href="{{ action('DivisionController@show', [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Retour</a>
            @elseif($situation_id == 5)
              <a href="{{ action('DirectionController@show', [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Retour</a>
            @else
              <a href="{{ action('DirectionController@show', [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Retour</a>
            @endif
        </div>
    </div>
</form>

@endsection
