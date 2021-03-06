@extends('layouts.app_show', \App\TypeMouvement::view_attributes_show($typemouvement))

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $typemouvement->id }}</dd>

    <dt class="col-sm-3">Libelle</dt>
    <dd class="col-sm-9">{{ $typemouvement->libelle }}</dd>

    <dt class="col-sm-3">Par Défaut</dt>
    <dd class="col-sm-9">
      <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $typemouvement->is_default ? 'checked="checked"' : '' }}/>
    </dd>

    <dt class="col-sm-3">Statut</dt>
    <dd class="col-sm-9">{{ $typemouvement->statut->libelle ?? '' }}</dd>

    <dt class="col-sm-3">Tags</dt>
    <dd class="col-sm-9">{{ $typemouvement->tags }}</dd>

    <dt class="col-sm-3">Créé le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typemouvement->created_at)) }}</dd>

    <dt class="col-sm-3">Modifié le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typemouvement->updated_at)) }}</dd>

    @include('recyclebin._details', ['currval' => $typemouvement])
</dl>

@endsection
