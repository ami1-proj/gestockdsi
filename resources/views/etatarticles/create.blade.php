@extends('layouts.app')

@section('page')
  Etats Article
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('etatarticles.create') }}
@endsection

@section('css')
    @include('tags.tags_css')
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Nouveau</h4>
          <p class="text-muted m-b-30 font-14">Créer un nouvel <code class="highlighter-rouge">Etat Article</code> dans le Système.</p>

          <form action="{{ route('etatarticles.store') }}" method="POST" enctype="multipart/form-data">

            @include('etatarticles.fields')

            @include('tags.tags_control')

            <div class="form-group row">
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
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
