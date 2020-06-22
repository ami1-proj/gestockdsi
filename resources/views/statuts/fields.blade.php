<div class="form-group row {{ $errors->has('libelle') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Libelle</label>
    <div class="col-sm-10">
      <input name="libelle" type="text" class="form-control" placeholder="Libellé du Statut" value="{{  old('nom', $statut->libelle ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('code') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Code</label>
    <div class="col-sm-10">
      <input name="code" type="text" class="form-control" placeholder="Code du Statut" value="{{  old('nom', $statut->code ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('code') ? $errors->first('code') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Par Défaut ?</label>
    <div class="col-sm-10">
      <input type="checkbox" name="is_default" class="switch-input" value="1" {{ old('is_default', $statut->is_default) ? 'checked="checked" disabled readonly' : '' }}/>
      @if(isset($statut->id) && $statut->is_default)
        <input type="hidden" name="is_default" value="true" />
      @endif
      <small class="text-danger">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</small>
    </div>
</div>

@csrf
