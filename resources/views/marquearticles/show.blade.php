@extends('layouts.app_show', \App\MarqueArticle::view_attributes_show($marquearticle))

@section('show_details')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $marquearticle->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $marquearticle->nom }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">
          <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $marquearticle->statut->code == 'actif' ? 'checked' : '' }}>
        </dd>

        @include('recyclebin._details', ['currval' => $marque])
    </dl>
@endsection
