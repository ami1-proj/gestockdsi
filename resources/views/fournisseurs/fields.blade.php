<div class="form-group row {{ $errors->has('nom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="nom">Nom</label>
    <div class="col-sm-10">
        <input name="nom" type="text" class="form-control" placeholder="Nom" value="{{  old('nom', $fournisseur->nom ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('prenom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="prenom">Prenom</label>
    <div class="col-sm-10">
        <input name="prenom" type="text" class="form-control" placeholder="Prenom" value="{{ old('prenom', $fournisseur->prenom ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('prenom') ? $errors->first('prenom') : '' }}</small>
    </div>
</div>

<!-- <div class="form-group row {{ $errors->has('raison_sociale') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="raison_sociale">Raison Sociale</label>
    <div class="col-sm-10">
        <input name="raison_sociale" type="text" class="form-control" placeholder="Raison Sociale" value="{{ old('raison_social', $fournisseur->raison_sociale ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('raison_sociale') ? $errors->first('raison_sociale') : '' }}</small>
    </div>
</div> -->


<div class="form-group row">
  <label class="col-sm-3 col-form-label">E-mail(s)</label>
</div>

<div class="form-group row">
  <label class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">

    @if(isset($fournisseur->id))
      <select class="select2 form-control " name="$fournisseuradresseemails[]" multiple="multiple" id="$fournisseuradresseemails" style="width: 50%">
        @foreach($fournisseur->adresseemails as $adresseemail)
            <option value="{{ $adresseemail->id }}">{{ $adresseemail->email }}</option>
        @endforeach
      </select>
      <div>
        <a href="{{ action('AdresseemailController@editelem', ['fournisseur', $fournisseur->id]) }}" class="btn btn-secondary waves-effect m-l-5">Gérer</a>
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

    @if(isset($fournisseur->id))
      <select class="select2 form-control " name="$fournisseurphonenums[]" multiple="multiple" id="$fournisseurphonenums" style="width: 50%">
        @foreach($fournisseur->phonenums as $phonenum)
            <option value="{{ $phonenum->id }}">{{ $phonenum->numero }}</option>
        @endforeach
      </select>
      <div>
        <a href="{{ action('PhonenumController@editelem', ['fournisseur', $fournisseur->id]) }}" class="btn btn-secondary waves-effect m-l-5">Gérer</a>
      </div>
    @else
      <div class="{{ $errors->has('nouveau_phone') ? 'has-error' : '' }}">
        <input name="nouveau_phone" type="text" class="form-control" placeholder="Nouveau Numéro de Phone" value="">
        <small class="text-danger">{{ $errors->has('nouveau_phone') ? $errors->first('nouveau_phone') : '' }}</small>
      </div>
    @endif

  </div>
</div>


<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <input name="statut_id" {{ Auth::user()->can(\App\Fournisseur::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $fournisseur->statut->code == 'actif' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
