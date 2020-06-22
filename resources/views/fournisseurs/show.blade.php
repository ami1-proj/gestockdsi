@extends('layouts.app_show', \App\Fournisseur::view_attributes_show($fournisseur))

@section('show_details')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $fournisseur->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $fournisseur->nom }}</dd>

        <dt class="col-sm-3">Prenom</dt>
        <dd class="col-sm-9">{{ $fournisseur->prenom }}</dd>

        <dt class="col-sm-3">Raison Sociale</dt>
        <dd class="col-sm-9">{{ $fournisseur->Raison_Sociale }}</dd>

        <dt class="col-sm-3">Adresse(s) E-mail</dt>
        <dd class="col-sm-9">
          <select class="select2 form-control " name="$Fournisseuradresseemails[]" multiple="multiple" id="$Fournisseuradresseemails" style="width: 50%">
            @foreach($fournisseur->adresseemails as $adresseemail)
                <option value="{{ $adresseemail->id }}">{{ $adresseemail->email }}</option>
            @endforeach
          </select>
        </dd>

        <dt class="col-sm-3">Numéro(s) de Téléphone</dt>
        <dd class="col-sm-9">
          <select class="select2 form-control " name="$Fournisseurphonenums[]" multiple="multiple" id="$Fournisseurphonenums" style="width: 50%">
            @foreach($fournisseur->phonenums as $phonenum)
                <option value="{{ $phonenum->id }}">{{ $phonenum->numero }}</option>
            @endforeach
          </select>
        </dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">
          <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $fournisseur->statut->code == 'actif' ? 'checked' : '' }}>
        </dd>

        <dt class="col-sm-3">Créé le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($fournisseur->created_at)) }}</dd>

        <dt class="col-sm-3">Modifié le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($fournisseur->updated_at)) }}</dd>

        @include('recyclebin._details', ['currval' => $fournisseur])
    </dl>
@endsection
