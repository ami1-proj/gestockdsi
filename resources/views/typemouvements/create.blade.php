@extends('layouts.app')

@section('page')
  Types Mouvement
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('typemouvements.create') }}
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
          <p class="text-muted m-b-30 font-14">Créer un nouveau <code class="highlighter-rouge">Type de Mouvement</code> dans le Système.</p>

          <form action="{{ route('typemouvements.store') }}" method="POST" enctype="multipart/form-data">

            @include('typemouvements.fields')

            @include('tags.tags_control')

            <div class="form-group row">
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                  <button type="reset" class="btn btn-success waves-effect waves-light">Reset</button>
                  <a href="{{ route('typemouvements.index') }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
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
