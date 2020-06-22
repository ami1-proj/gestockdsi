

<div class="form-group {{ $errors->has('intitulé') ? 'has-error' : '' }}">
    {{ Form::label('intitulé_direction', 'direction') }}
    {{ Form::text('direction', $direction->intitulé, ['class'=>'form-control border-input','placeholder'=>'intiltulé de la direction']) }}
    <span class="text-danger">{{ $errors->has('intitulé') ? $errors->first('intitulé') : '' }}</span>
</div>


<div class="form-group {{ $errors->has('responsable') ? 'has-error' : '' }}">
    {{ Form::label('responsable_direction', 'responsable') }}
    {{ Form::text('responsable', $direction->responsable, ['class'=>'form-control border-input','placeholder'=>'responsable de direction']) }}
    <span class="text-danger">{{ $errors->has('responsable') ? $errors->first('responsable') : '' }}</span>
</div>



<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_direction', 'Statut') }}
    {{ Form::text('statut', $direction->statut, ['class'=>'form-control border-input','placeholder'=>'statut de la direction']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>

