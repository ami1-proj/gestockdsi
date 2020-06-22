<div class="form-group row {{ $errors->has('intitule') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="intitule">intitule</label>
    <div class="col-sm-10">
        <input name="intitule" type="text" class="form-control" placeholder="intitule" value="{{ old('intitule', $agence->intitule ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('intitule') ? $errors->first('intitule') : '' }}</small>
    </div>
</div>
  

<div class="form-group row {{ $errors->has('employe_responsable_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="employe_responsable_id">Responsable</label>
    <div class="col-sm-10">
        <select name="employe_responsable_id" class="form-control" id="employe_responsable_id" required>
            <option selected disabled>Selectionnez un employe</option>
            @foreach($employes as $id => $display)
            @if (old('employe_id') == $id)
              <option value="{{ $id }}" selected>{{ $display }}</option>
            @else
                <option value="{{ $id }}" {{ (isset($agence->employe_responsable_id) && $id === $agence->employe_responsable_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endif  
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('employe_responsable_id') ? $errors->first('employe_responsable_id') : '' }}</small>
    </div>
</div>
 

  
<div class="form-group row {{ $errors->has('zone_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="zone_id">Zone</label>
    <div class="col-sm-10">
        <select name="zone_id" class="form-control" id=zone_id" required>
            <option selected disabled>Selectionnez une zone</option>
            @foreach($zones as $id => $display)
            @if (old('zone_id') == $id)
               <option value="{{ $id }}" selected>{{ $display }}</option>
              @else
                <option value="{{ $id }}" {{ (isset($agence->zone_id) && $id === $agence->zone_id) ? 'selected' : '' }}>{{ $display }}</option>
             @endif
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('zone_id') ? $errors->first('zone_id') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <select name="statut_id" class="form-control" id="statut_id" required>
            @foreach($statuts as $id => $display)
                <option value="{{ $id }}" {{ (isset($agence->statut_id) && $id === $agence->statut_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>



@csrf

