
<div class="form-group {{ $errors->has('intitulé') ? 'has-error' : '' }}">
    {{ Form::label('intitulé_services', 'intitulé') }}
    {{ Form::text('services', $service->intitulé, ['class'=>'form-control border-input','placeholder'=>'intiltulé de la service']) }}
    <span class="text-danger">{{ $errors->has('intitulé') ? $errors->first('intitulé') : '' }}</span>
</div>


<div class="form-group {{ $errors->has('responsable') ? 'has-error' : '' }}">
    {{ Form::label('responsable_service', 'responsable') }}
    {{ Form::text('responsable', $service->responsable, ['class'=>'form-control border-input','placeholder'=>'responsable du service']) }}
    <span class="text-danger">{{ $errors->has('responsable') ? $errors->first('responsable') : '' }}</span>
</div>



<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_service', 'Statut') }}
    {{ Form::text('statut', $service->statut, ['class'=>'form-control border-input','placeholder'=>'statut du service']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>

