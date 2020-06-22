@extends('layouts.app_show', \App\Employe::view_attributes_show($employe))

@section('show_details')

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $employe->id }}</dd>

            <dt class="col-sm-3">Nom</dt>
            <dd class="col-sm-9">{{ $employe->nom }}</dd>

            <dt class="col-sm-3">Prénom</dt>
            <dd class="col-sm-9">{{ $employe->prenom }}</dd>

            <dt class="col-sm-3">Matricule</dt>
            <dd class="col-sm-9">{{ $employe->matricule }}</dd>

            <dt class="col-sm-3">Fonction</dt>
            <dd class="col-sm-9">{{ $employe->fonction->intitule }}</dd>

            <dt class="col-sm-3">Département</dt>
            <dd class="col-sm-9">{{ $employe->departement->chemin_complet }}</dd>

            <dt class="col-sm-3">Adresse(s) E-mail</dt>
            <dd class="col-sm-9">
              <select class="select2 form-control " name="$employeadresseemails[]" multiple="multiple" id="$employeadresseemails" style="width: 50%">
                @foreach($employe->adresseemails as $adresseemail)
                    <option value="{{ $adresseemail->id }}">{{ $adresseemail->email }}</option>
                @endforeach
              </select>
            </dd>

            <dt class="col-sm-3">Numéro(s) de Téléphone</dt>
            <dd class="col-sm-9">
              <select class="select2 form-control " name="$employephonenums[]" multiple="multiple" id="$employephonenums" style="width: 50%">
                @foreach($employe->phonenums as $phonenum)
                    <option value="{{ $phonenum->id }}">{{ $phonenum->numero }}</option>
                @endforeach
              </select>
            </dd>

            <dt class="col-sm-3">Statut</dt>
            <dd class="col-sm-9">
              <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $employe->statut->code == 'actif' ? 'checked' : '' }}>
            </dd>

            <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($employe->created_at)) }}</dd>

            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($employe->updated_at)) }}</dd>

            @include('recyclebin._details', ['currval' => $employe])
        </dl>

      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        @include('affectations.liste', ['type_affectation_tag' => 'Employe', 'elem' => $employe, 'affectations' => $employe->affectations])

      </div>
    </div>
  </div>
</div>

@endsection
