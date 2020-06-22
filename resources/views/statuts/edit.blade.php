@extends('layouts.app')

@section('page')
  Statuts
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('statuts.edit',$statut->id) }}
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
          <p class="text-muted m-b-30 font-14">Modification du Statut <code class="highlighter-rouge">{{ $statut->libelle }}</code>.</p>

          <form action="{{ route('statuts.update', ['statut' => $statut]) }}" method="POST">
            @method('PUT')
            @include('statuts.fields')

            @include('tags.tags_control')

            <div class="form-group row">
                <div>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                  <button type="reset" class="btn btn-success waves-effect waves-light">Reset</button>
                  <a href="{{ route('statuts.index') }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
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
