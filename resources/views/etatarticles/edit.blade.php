@extends('layouts.app')

@section('page')
  Etats Article
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('etatarticles.edit',$etatarticle->id) }}
@endsection

@section('css')
    @include('tags.tags_css')
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Modification</h4>
          <p class="text-muted m-b-30 font-14">Modification de l’Etat d’article <code class="highlighter-rouge">{{ $etatarticle->libelle }}</code>.</p>

          <form action="{{ route('etatarticles.update', ['etatarticle' => $etatarticle]) }}" method="POST">
            @method('PUT')
            @include('etatarticles.fields')

            @include('tags.tags_control')

            <div class="form-group row">
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                  <button type="reset" class="btn btn-success waves-effect waves-light">Reset</button>
                  <a href="{{ route('etatarticles.index') }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
                </div>
            </div>

          </form>

        </div>
    </div>
  </div>
</div>

@endsection

@section('js')
    @include('tags.tags_js')
@endsection
