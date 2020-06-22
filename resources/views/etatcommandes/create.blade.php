@extends('layouts.app')

@section('page')
  Etats Commande
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('etatcommandes.create') }}
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
          <p class="text-muted m-b-30 font-14">Créer un nouvel <code class="highlighter-rouge">Etat de Commande</code> dans le Système.</p>

          <form action="{{ route('etatcommandes.store') }}" method="POST" enctype="multipart/form-data">

            @include('etatcommandes.fields')

            @include('tags.tags_control')

            <div class="form-group row">
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                  <button type="reset" class="btn btn-success waves-effect waves-light">Reset</button>
                  <a href="{{ route('etatcommandes.index') }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
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
