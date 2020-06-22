<div class="form-group {{ $errors->has('libelle') ? 'has-error' : '' }}">
    {{ Form::label('libelle_statut', 'Libelle') }}
    {{ Form::text('libelle', $statut->libelle, ['class'=>'form-control border-input','placeholder'=>'Libelle du statut']) }}
    <span class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</span>
</div>