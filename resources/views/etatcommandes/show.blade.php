@extends('layouts.app_show', \App\EtatCommande::view_attributes_show($etatcommande))

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $etatcommande->id }}</dd>

    <dt class="col-sm-3">Libelle</dt>
    <dd class="col-sm-9">{{ $etatcommande->libelle }}</dd>

    <dt class="col-sm-3">Par Défaut</dt>
    <dd class="col-sm-9">
      <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $etatcommande->is_default ? 'checked="checked"' : '' }}/>
    </dd>

    <dt class="col-sm-3">Statut</dt>
    <dd class="col-sm-9">{{ $etatcommande->statut->libelle ?? '' }}</dd>

    <dt class="col-sm-3">Tags</dt>
    <dd class="col-sm-9">{{ $etatcommande->tags }}</dd>

    <dt class="col-sm-3">Créé le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($etatcommande->created_at)) }}</dd>

    <dt class="col-sm-3">Modifié le</dt>
    <dd class="col-sm-9">{{ date('F d, Y', strtotime($etatcommande->updated_at)) }}</dd>

    @include('recyclebin._details', ['currval' => $etatcommande])
</dl>

@endsection
