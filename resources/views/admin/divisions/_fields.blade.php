

<div class="form-group {{ $errors->has('intitulé') ? 'has-error' : '' }}">
    {{ Form::label('intitulé_division', 'division') }}
    {{ Form::text('division', $division->intitulé, ['class'=>'form-control border-input','placeholder'=>'intiltulé de la division']) }}
    <span class="text-danger">{{ $errors->has('intitulé') ? $errors->first('intitulé') : '' }}</span>
</div>


<div class="form-group {{ $errors->has('responsable') ? 'has-error' : '' }}">
    {{ Form::label('responsable_division', 'responsable') }}
    {{ Form::text('responsable', $division->responsable, ['class'=>'form-control border-input','placeholder'=>'responsable de division']) }}
    <span class="text-danger">{{ $errors->has('responsable') ? $errors->first('responsable') : '' }}</span>
</div>



<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_division', 'Statut') }}
    {{ Form::text('statut', $division->statut, ['class'=>'form-control border-input','placeholder'=>'statut de la division']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>

