<div class="form-group row {{ $errors->has('objet') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="objet">Objet</label>
    <div class="col-sm-10">
        <input name="objet" type="text" class="form-control" placeholder="Objet" value="{{ old('objet', $affectation->objet ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('objet') ? $errors->first('objet') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('date_debut') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="objet">Date Affectation</label>
    <div class="col-sm-10">

        <div class="input-group">
            <input name="date_debut" type="text" class="form-control" placeholder="dd/mm/yyyy" id="datepicker-autoclose" value="{{ old('date_debut', $affectation->date_debut ?? $nowdate) }}" >
            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
        </div>
        <small class="text-danger">{{ $errors->has('date_debut') ? $errors->first('date_debut') : '' }}</small>

    </div>
</div>


@if(isset($affectation->id))
    <div class="form-group row {{ $errors->has('details') ? 'has-error' : '' }}">
        <label class="col-sm-2 col-form-label" for="details">Details</label>
        <div class="col-sm-10">
            <input name="details" type="text" class="form-control" placeholder="Details Modification" value="{{ old('details', $affectation->details ?? '') }}"/>
            <small class="text-danger">{{ $errors->has('details') ? $errors->first('details') : '' }}</small>
        </div>
    </div>
@endif
