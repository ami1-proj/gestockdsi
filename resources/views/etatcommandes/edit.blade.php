@extends('layouts.app')

@section('page')
  Etats Commande
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('etatcommandes.edit',$etatcommande->id) }}
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
          <p class="text-muted m-b-30 font-14">Modification de l’Etat de Commande <code class="highlighter-rouge">{{ $etatcommande->libelle }}</code>.</p>

          <form action="{{ route('etatcommandes.update', ['etatcommande' => $etatcommande]) }}" method="POST">
            @method('PUT')
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
