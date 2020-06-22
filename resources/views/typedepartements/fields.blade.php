<div class="form-group row {{ $errors->has('intitule') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Libelle</label>
    <div class="col-sm-10">
      <input name="intitule" type="text" class="form-control" placeholder="Libellé du Type de Département" value="{{  old('intitule', $typedepartement->intitule ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('intitule') ? $errors->first('intitule') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Par Défaut ?</label>
    <div class="col-sm-10">
      <input type="checkbox" name="is_default" class="switch-input" value="1" {{ old('is_default', $typedepartement->is_default) ? 'checked="checked" disabled readonly' : '' }}/>
      @if(isset($typedepartement->id) && $typedepartement->is_default)
        <input type="hidden" name="is_default" value="true" />
      @endif
      <small class="text-danger">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
      <input name="statut_id" {{ Auth::user()->can(\App\TypeDepartement::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $typedepartement->statut->code == 'actif' ? 'checked' : '' }}>
      <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
