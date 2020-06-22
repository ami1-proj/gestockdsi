<div class="form-group row {{ $errors->has('intitule') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="intitule">Intitule</label>
    <div class="col-sm-10">
        <input name="intitule" type="text" class="form-control" placeholder="intitule" value="{{ old('intitule') }}"/>
        <small class="text-danger">{{ $errors->has('intitule') ? $errors->first('intitule') : '' }}</small>
    </div>
</div>


<div class="form-group row {{ $errors->has('employe_responsable_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="employe_responsable_id">Responsable</label>
    <div class="col-sm-10">
        <select name="employe_responsable_id" class="form-control" id="employe_responsable_id" required>
            <option selected disabled>Selectionnez un Employe</option>
            @foreach($employes as $id => $display)
                <option value="{{ $id }}" {{ (isset($direction->employe_responsable_id) && $id === $direction->employe_responsable_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('employe_responsable_id') ? $errors->first('employe_responsable_id') : '' }}</small>
    </div>
</div>



<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <select name="statut_id" class="form-control" id="statut_id" required>
            @foreach($statuts as $id => $display)
                <option value="{{ $id }}" {{ (isset($direction->statut_id) && $id === $direction->statut_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>



@csrf
