@extends('layouts.app_show', \App\TypeArticle::view_attributes_show($typearticle))

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $typearticle->id }}</dd>

    <dt class="col-sm-3">Libelle</dt>
    <dd class="col-sm-9">{{ $typearticle->libelle }}</dd>

    <dt class="col-sm-3">Description</dt>
    <dd class="col-sm-9">{{ $typearticle->description }}</dd>

    <dt class="col-sm-3">Image</dt>
    <dd class="col-sm-9"><img src="{{ url(config('app.typearticle_filefolder')).'/'. $typearticle->image }}" alt="" class="img-thumbnail" style="width: 150px;"></dd>

    <dt class="col-sm-3">Statut</dt>
    <dd class="col-sm-9">
      <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $typearticle->statut->code == 'actif' ? 'checked' : '' }}>
    </dd>

    <dt class="col-sm-3">Créé le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typearticle->created_at)) }}</dd>

    <dt class="col-sm-3">Modifié le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typearticle->updated_at)) }}</dd>

    @include('recyclebin._details', ['currval' => $typearticle])
</dl>

@endsection
