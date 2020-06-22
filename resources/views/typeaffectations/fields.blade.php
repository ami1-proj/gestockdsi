<div class="form-group row {{ $errors->has('libelle') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="nom">Libelle</label>
    <div class="col-sm-10">
      <input name="libelle" type="text" class="form-control" placeholder="Libellé du Type d Affectation" value="{{  old('libelle', $typeaffectation->libelle ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_default') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="prenom">Par Défaut ?</label>
    <div class="col-sm-10">
      <input type="checkbox" name="is_default" class="switch-input" value="1" {{ old('is_default', $typeaffectation->is_default) ? 'checked="checked" disabled readonly' : '' }}/>
      @if(isset($typeaffectation->id) && $typeaffectation->is_default)
        <input type="hidden" name="is_default" value="true" />
      @endif
      <small class="text-danger">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('object_class_name') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="object_class_name">Classe</label>
    <div class="col-sm-10">
      <input name="object_class_name" type="text" class="form-control" placeholder="Classe de l objet" value="{{  old('object_class_name', $typeaffectation->object_class_name ?? '') }}"/>
      <small class="text-danger">{{ $errors->has('object_class_name') ? $errors->first('object_class_name') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
      <input name="statut_id" {{ Auth::user()->can(\App\TypeAffectation::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $typeaffectation->statut->code == 'actif' ? 'checked' : '' }}>
      <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
