@extends('layouts.app')

@section('page')
    @include('layouts._button_index', ['canlist' => App\Affectation::canlist(), 'index_route' => \App\Affectation::$route_index, 'model' => $affectation, 'title' => 'Affectations'])
@endsection

@section('breadcrumb')
    {{ Breadcrumbs::render($elem_arr['breadcrumb_ficheretour'],$elem_arr['elem']->id,$affectation->id) }}
@endsection

@section('content')

    <div class="row">
        @include('layouts.message')
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                @if(@isset($affectation->fiche_retour))
                    <div class="card-body embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src ="{{ asset( '/laraview/#../' . config('app.affectationficheretour_filefolder') . '/' . $affectation->fiche_retour ) }}" width="1000px" height="600px"></iframe>
                    </div>
                @else
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Fiche Retour</h4>
                        <p class="text-muted m-b-30 font-14">Charger la <code class="highlighter-rouge">fiche de Retour</code>.</p>

                        <form action="{{ action('AffectationController@addFicheretour', $affectation->id) }}" method="POST" enctype="multipart/form-data">

                            <div class="form-group row {{ $errors->has('fiche_retour') ? 'has-error' : '' }}">
                                <label class="col-sm-2 col-form-label" for="image">Fichier PDF</label>
                                <div class="col-sm-10">
                                    <input type="file" name="fiche_retour" id="fiche_retour" class="form-control border-input" value="''"/>
                                    <div id="thumb-output"></div>
                                    <small class="text-danger">{{ $errors->has('fiche_retour') ? $errors->first('fiche_retour') : '' }}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div>
                                    @can(\App\Affectation::canprint())
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                                    @endcan
                                    <a href="{{ action($elem_arr['showController'], [$elem_arr['elem']->id]) }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
                                </div>
                            </div>

                            @csrf

                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
