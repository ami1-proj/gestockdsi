@extends('layouts.app')

@section('page')
  Affectations
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_edit'],$elem_arr['elem']->id,$affectation) }}
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Modification Affectation {{ $elem_arr['type'] }}</h4>

          <p class="text-muted m-b-30 font-14">Modifer l affection <code class="highlighter-rouge"><strong>{{ $affectation->objet }}</strong></code>  assignee {{ $elem_arr['article'] }}  {{ $elem_arr['type'] }} <strong>{{ $elem_arr['elem']->denomination }}</strong>.</p>

          <form action="{{ route('affectations.update', ['affectation' => $affectation]) }}" method="POST">
          @method('PUT')

          <div class="row">
            <div class="col-12">
              <div class="card m-b-30">
                <div class="card-body">

                  <div class="form-group row {{ $errors->has('objet') ? 'has-error' : '' }}">
                      <label class="col-sm-2 col-form-label" for="objet">Objet</label>
                      <div class="col-sm-10">
                          <input name="objet" type="text" class="form-control" placeholder="Objet" value="{{ $affectation->objet ?? '' }}"/>
                          <small class="text-danger">{{ $errors->has('objet') ? $errors->first('objet') : '' }}</small>
                      </div>
                  </div>

                  </div>
                </div>
              </div>
          </div>

          <div class="row">

            <div class="col-lg-6">
              <div class="card m-b-30">
                <div class="card-body">

                  <h6 class="card-title">Article(s) affectés</h6>
                  <p class="card-text"><small class="text-muted m-b-30 font-10">Sélectionnez un ou plusieurs articles a <code class="highlighter-rouge"><strong>Retirer</strong></code> de cette affectation. Gardez la touche <code class="highlighter-rouge">Ctrl</code> enfoncé pour sélectionner plusieurs ou déselectionner.</small></p>

                  <div class="form-group row {{ $errors->has('liste_articles_affectes') ? 'has-error' : '' }}">
                    <select class="select2 form-control" name="liste_articles_affectes[]" multiple="multiple" id="liste_articles_affectes">
                      @foreach($affectation->affectationarticles as $affectationarticle)
                        <option value="{{ $affectationarticle->article->id }}">{{ $affectationarticle->article->reference_complete }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->has('liste_articles_affectes') ? $errors->first('liste_articles_affectes') : '' }}</small>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card m-b-30">
                <div class="card-body">
                  <h6 class="card-title">Article(s) disponibles</h6>
                  <p class="card-text"><small class="text-muted m-b-30 font-10">Sélectionnez un ou plusieurs articles a <code class="highlighter-rouge"><strong>Ajouter</strong></code> dans cette affection. Gardez la touche <code class="highlighter-rouge">Ctrl</code> enfoncé pour sélectionner plusieurs ou déselectionner.</small></p>

                  <div class="form-group row {{ $errors->has('articles_disponibles') ? 'has-error' : '' }}">
                    <select class="select2 form-control" name="articles_disponibles[]" multiple="multiple" id="articles_disponibles">
                      @foreach($articles_disponibles as $id => $display)
                        <option value="{{ $id }}">{{ $display }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->has('articles_disponibles') ? $errors->first('articles_disponibles') : '' }}</small>
                  </div>

                </div>
              </div>
            </div>

          </div>

              <div class="row">
                <div class="col-12">
                  <div class="card m-b-30">
                    <div class="card-body">

                      <div class="form-group row {{ $errors->has('type_mouvement_id') ? 'has-error' : '' }}">
                          <label class="col-sm-2 col-form-label" for="type_mouvement_id">Type Mouvement</label>
                          <div class="col-sm-10">
                              <select name="type_mouvement_id" class="form-control" id="type_mouvement_id" required>
                                  <option selected disabled>Selectionnez un type de Mouvement</option>
                                  @foreach($type_mouvements as $id => $display)
                                      <option value="{{ $id }}">{{ $display }}</option>
                                  @endforeach
                              </select>
                              <small class="text-danger">{{ $errors->has('type_mouvement_id') ? $errors->first('type_mouvement_id') : '' }}</small>
                          </div>
                      </div>

                      <div class="form-group row {{ $errors->has('details') ? 'has-error' : '' }}">
                          <label class="col-sm-2 col-form-label" for="details">Details</label>
                          <div class="col-sm-10">
                              <input name="details" type="text" class="form-control" placeholder="Details Mouvement" value="{{ $affectation->details ?? '' }}"/>
                              <small class="text-danger">{{ $errors->has('details') ? $errors->first('details') : '' }}</small>
                          </div>
                      </div>

                      </div>
                    </div>
                  </div>
              </div>

              @csrf

                <div class="form-group row">
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Valider</button>
                        <a href="{{ action($elem_arr['showController'], [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>

                <input type="hidden" name="elem_id" value="{{$elem_arr['elem']->id}}"/>

        </form>

      </div>
    </div>
  </div>
</div>

@endsection
