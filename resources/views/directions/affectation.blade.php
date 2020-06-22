@extends('layouts.app')

@section('page')
  Affectations a la Direction
@endsection

@section('content')
    
    <div class="row">
        @include('layouts.message')
    </div>

    <form action="{{ route('directions.affectationupdate', ['direction' => $direction]) }}" method="POST">
    @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Affectation</h4>
                        <p class="text-muted m-b-30 font-14">Gestion des articles de la Direction <code class="highlighter-rouge" style=""><strong>{{ $direction->intitule }}</strong></code>.
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
                        <h4 class="mt-0 header-title">Articles de la Direction</h4>
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
            <a href="{{ action('DirectionController@show', ['direction' => $direction->id]) }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</form>


@endsection
