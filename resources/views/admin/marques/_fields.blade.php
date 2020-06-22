<div class="form-group {{ $errors->has('libelle') ? 'has-error' : '' }}">
    {{ Form::label('libelle_marque', 'Libelle') }}
    {{ Form::text('libelle', $marque->libelle, ['class'=>'form-control border-input','placeholder'=>'Libelle de la marque']) }}
    <span class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('nationalite') ? 'has-error' : '' }}">
    {{ Form::label('nationalite_marque', 'nationalite') }}
    {{ Form::text('natonalite', $marque->nationalite, ['class'=>'form-control border-input','placeholder'=>'nationalité de la marque']) }}
    <span class="text-danger">{{ $errors->has('nationalite') ? $errors->first('nationalite') : '' }}</span>
</div>