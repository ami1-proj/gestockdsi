<div class="form-group row {{ $errors->has('intitule') ? 'has-error' : $errors->has('chemin_complet') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="intitule">Intitule</label>
    <div class="col-sm-10">
        <input name="intitule" type="text" class="form-control" placeholder="Intitulé du Département" value="{{  old('intitule', $departement->intitule ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('intitule') ? $errors->first('intitule') : '' }}</small>
        <small class="text-danger">{{ $errors->has('chemin_complet') ? $errors->first('chemin_complet') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('employe_responsable_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="employe_responsable_id">Responsable</label>
    <div class="col-sm-10">
        <select name="employe_responsable_id" class="employe_id form-control" id="employe_responsable_id" required>
            <option selected disabled>Selectionnez un Employe</option>
            @foreach($employes as $id => $display)
                <option value="{{ $id }}" {{ (isset($departement->employe_responsable_id) && $id === $departement->employe_responsable_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('employe_responsable_id') ? $errors->first('employe_responsable_id') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('departement_parent_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="departement_parent_id">Département Parent</label>
    <div class="col-sm-10">
        <select name="departement_parent_id" class="departement_id form-control" id="departement_parent_id" required>
            <option selected disabled>Selectionnez un Département</option>
            @foreach($departements as $id => $display)
                <option value="{{ $id }}" {{ (isset($departement->departement_parent_id) && $id === $departement->departement_parent_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('departement_parent_id') ? $errors->first('departement_parent_id') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('type_departement_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Type Département</label>
    <div class="col-sm-10">
        <select name="type_departement_id" class="form-control" id="type_departement_id" required>
            <option selected disabled>Selectionnez un Type de Département</option>
            @foreach($typedepartements as $id => $display)
                <option value="{{ $id }}" {{ (isset($departement->type_departement_id) && $id === $departement->type_departement_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('type_departement_id') ? $errors->first('type_departement_id') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <input name="statut_id" {{ Auth::user()->can(\App\Departement::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $departement->statut->code == 'actif' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
