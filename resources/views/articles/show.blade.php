@extends('layouts.app_show', \App\Article::view_attributes_show($article))

@section('show_details')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $article->id }}</dd>

        <dt class="col-sm-3">Référence</dt>
        <dd class="col-sm-9">{{ $article->reference }}</dd>

        <dt class="col-sm-3">Taille</dt>
        <dd class="col-sm-9">{{ $article->taille }}</dd>

        <dt class="col-sm-3">Situation</dt>
        <dd class="col-sm-9">{{ $article->situation()->typeAffectation->libelle }}</dd>

        <dt class="col-sm-3">Date de livraison</dt>
        <dd class="col-sm-9">{{ $article->date_livraison }}</dd>

        <dt class="col-sm-3">Type</dt>
        <dd class="col-sm-9">{{ $article->typeArticle->libelle ?? '' }}</dd>

        <dt class="col-sm-3">Fournisseurs</dt>  
        <dd class="col-sm-9">{{ $article->fournisseur->nom ?? '' }}</dd>

        <dt class="col-sm-3">Marque</dt>
        <dd class="col-sm-9">{{ $article->marqueArticle->nom ?? '' }}</dd>

        <dt class="col-sm-3">Etat</dt>
        <dd class="col-sm-9">{{ $article->etatArticle->libelle ?? '' }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">
          <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $article->statut->code == 'actif' ? 'checked' : '' }}>
        </dd>

        @include('recyclebin._details', ['currval' => $article])

    </dl>
@endsection
  