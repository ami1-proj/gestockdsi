<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
    {{ Form::label('nom_stock', 'nom') }}
    {{ Form::text('nom', $stock->nom, ['class'=>'form-control border-input','placeholder'=>'nom du stock']) }}
    <span class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('lieu') ? 'has-error' : '' }}">
    {{ Form::label('lieu_stock', 'lieu') }}
    {{ Form::textarea('lieu', $stock->lieu, ['class'=>'form-control border-input','placeholder'=>'lieu du stock']) }}
    <span class="text-danger">{{ $errors->has('lieu') ? $errors->first('lieu') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_stock', 'Statut') }}
    {{ Form::text('statut', $stock->statut, ['class'=>'form-control border-input','placeholder'=>'statut du stock']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>

