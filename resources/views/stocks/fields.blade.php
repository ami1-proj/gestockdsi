<div class="form-group row {{ $errors->has('nom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="nom">Nom</label>
    <div class="col-sm-10">
        <input name="nom" type="text" class="form-control" placeholder="nom" value="{{ $service->nom ?? '' }}"/>
        <small class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</small>
    </div>
</div>


<div class="form-group row {{ $errors->has('stock_lieu_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="stock_lieu_id">Lieu</label>
    <div class="col-sm-10">
        <select name="stock_lieu_id" class="form-control" id="stock_lieu_id" required>
          <option selected disabled>Selectionnez un Lieu</option>
            @foreach($stock_lieus as $id => $display)
                <option value="{{ $id }}" {{ (isset($stock->stock_lieu_id) && $id === $stock->stock_lieu_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('stock_lieu_id') ? $errors->first('stock_lieu_id') : '' }}</small>
    </div>
</div>


<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <input name="statut_id" {{ Auth::user()->can(\App\Sock::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $stock->statut->code == 'actif' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>



@csrf
