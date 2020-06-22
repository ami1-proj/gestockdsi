@extends('layouts.app_show', \App\TypeAffectation::view_attributes_show($typeaffectation))

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $typeaffectation->id }}</dd>

    <dt class="col-sm-3">Libelle</dt>
    <dd class="col-sm-9">{{ $typeaffectation->libelle }}</dd>

    <dt class="col-sm-3">Par Défaut</dt>
    <dd class="col-sm-9">
      <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $typeaffectation->is_default ? 'checked="checked"' : '' }}/>
    </dd>

    <dt class="col-sm-3">Statut</dt>
    <dd class="col-sm-9">{{ $typeaffectation->statut->libelle ?? '' }}</dd>

    <dt class="col-sm-3">Tags</dt>
    <dd class="col-sm-9">{{ $typeaffectation->tags }}</dd>

    <dt class="col-sm-3">Classe</dt>
    <dd class="col-sm-9">{{ $typeaffectation->object_class_name }}</dd>

    <dt class="col-sm-3">Créé le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typeaffectation->created_at)) }}</dd>

    <dt class="col-sm-3">Modifié le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($typeaffectation->updated_at)) }}</dd>

    @include('recyclebin._details', ['currval' => $typeaffectation])
</dl>

@endsection
