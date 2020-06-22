@extends('layouts.app_show', \App\Statut::view_attributes_show($statut))

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $statut->id }}</dd>

    <dt class="col-sm-3">Libelle</dt>
    <dd class="col-sm-9">{{ $statut->libelle }}</dd>

    <dt class="col-sm-3">Par Défaut</dt>
    <dd class="col-sm-9">
      <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $statut->is_default ? 'checked="checked"' : '' }}/>
    </dd>

    <dt class="col-sm-3">Tags</dt>
    <dd class="col-sm-9">{{ $statut->tags }}</dd>

    <dt class="col-sm-3">Créé le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($statut->created_at)) }}</dd>

    <dt class="col-sm-3">Modifié le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($statut->updated_at)) }}</dd>

    @include('recyclebin._details', ['currval' => $statut])
</dl>

@endsection
