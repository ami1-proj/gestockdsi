<div class="form-group row {{ $errors->has('nom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Nom</label>
    <div class="col-sm-10">
      <input name="nom" type="text" class="form-control" placeholder="Nom de l’Employé" value="{{  old('nom', $employe->nom ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('prenom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Prenom</label>
    <div class="col-sm-10">
      <input name="prenom" type="text" class="form-control" placeholder="Prénom de l’Employé" value="{{ old('prenom', $employe->prenom ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('prenom') ? $errors->first('prenom') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('matricule') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Matricule</label>
    <div class="col-sm-10">
      <input name="matricule" type="text" class="form-control" placeholder="Matricule de l’Employé" value="{{ old('matricule', $employe->matricule ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('matricule') ? $errors->first('matricule') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('fonction_employe_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="fonction_employe_id">Fonction</label>
    <div class="col-sm-8">
      <select name="fonction_employe_id" class="fonction_employe_id form-control" id="fonction_employe_id" required>
          @if(isset($employe->id))
            @foreach($fonctionemployes as $id => $display)
              @if (old('fonction_employe_id') == $id)
                <option value="{{ $id }}" selected>{{ $display }}</option>
              @else
                <option value="{{ $id }}" {{ ( isset($employe->fonction_employe_id) && $id === $employe->fonction_employe_id ) ? 'selected' : '' }}>{{ $display }}</option>
              @endif
            @endforeach
          @endif
      </select>

      <small class="text-danger">{{ $errors->has('fonction_employe_id') ? $errors->first('fonction_employe_id') : '' }}</small>
    </div>

    <div class="col-sm-2">
      <button type="button" class="btn bg-transparent" id="create-fonctionemploye" data-item-id="1"><i class="ion-plus-round" style="color:green"></i></button>
    </div>

</div>

<div class="form-group row {{ $errors->has('departement_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Département</label>
    <div class="col-sm-10">
      <select name="departement_id" class="departement_id form-control" id="departement_id" required>
        @if(isset($employe->id))
          @foreach($departements as $id => $display)
            @if (old('departement_id') == $id)
              <option value="{{ $id }}" selected>{{ $display }}</option>
            @else
              <option value="{{ $id }}" {{ (isset($employe->departement_id) && $id === $employe->departement_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endif
          @endforeach
        @endif
      </select>
      <small class="text-danger">{{ $errors->has('departement_id') ? $errors->first('departement_id') : '' }}</small>
    </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">E-mail(s)</label>
</div>

<div class="form-group row">
  <label class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">

    @if(isset($employe->id))
      <select class="select2 form-control " name="$employeadresseemails[]" multiple="multiple" id="$employeadresseemails" style="width: 50%">
        @foreach($employe->adresseemails as $adresseemail)
            <option value="{{ $adresseemail->id }}">{{ $adresseemail->email }}</option>
        @endforeach
      </select>
      <div>
        <a href="{{ action('AdresseemailController@editelem', ['employe', $employe->id]) }}" class="btn btn-secondary waves-effect m-l-5">Gérer</a>
      </div>
    @else
      <div class="{{ $errors->has('nouveau_email') ? 'has-error' : '' }}">
        <input name="nouveau_email" type="text" class="form-control" placeholder="Nouveau E-mail" value="">
        <small class="text-danger">{{ $errors->has('nouveau_email') ? $errors->first('nouveau_email') : '' }}</small>
      </div>
    @endif

  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Telephone(s)</label>
</div>

<div class="form-group row">
  <label class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">

    @if(isset($employe->id))
      <select class="select2 form-control " name="$employephonenums[]" multiple="multiple" id="$employephonenums" style="width: 50%">
        @foreach($employe->phonenums as $phonenum)
            <option value="{{ $phonenum->id }}">{{ $phonenum->numero }}</option>
        @endforeach
      </select>
      <div>
        <a href="{{ action('PhonenumController@editelem', ['employe', $employe->id]) }}" class="btn btn-secondary waves-effect m-l-5">Gérer</a>
      </div>
    @else
      <div class="{{ $errors->has('nouveau_phone') ? 'has-error' : '' }}">
        <input name="nouveau_phone" type="text" class="form-control" placeholder="Nouveau Numéro de Phone" value="">
        <small class="text-danger">{{ $errors->has('nouveau_phone') ? $errors->first('nouveau_phone') : '' }}</small>
      </div>
    @endif

  </div>
</div>

<div class="form-group row {{ $errors->has('adresse') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="adresse">Adresse</label>
    <div class="col-sm-10">
      <input name="adresse" type="text" class="form-control" placeholder="Adresse de l’Employé" value="{{ $employe->adresse ?? '' }}"/>
      <small class="text-danger">{{ $errors->has('adresse') ? $errors->first('adresse') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
      <input name="statut_id" {{ Auth::user()->can(\App\Employe::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $employe->statut->code == 'actif' ? 'checked' : '' }}>
      <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
