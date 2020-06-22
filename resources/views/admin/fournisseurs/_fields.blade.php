<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
    {{ Form::label('nom_founisseur', 'nom') }}
    {{ Form::text('nom', $fournisseur->nom, ['class'=>'form-control border-input','placeholder'=>'le nom du fournisseur']) }}
    <span class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
    {{ Form::label('telephone_fournisseur', 'telephone') }}
    {{ Form::text('telepone', $fournisseur->telephone, ['class'=>'form-control border-input','placeholder'=>'telephone du fournisseur']) }}
    <span class="text-danger">{{ $errors->has('telephone') ? $errors->first('telephone') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('adresse') ? 'has-error' : '' }}">
    {{ Form::label('adresse_fournisseur', 'adresse') }}
    {{ Form::text('adressse', $fournisseur->adresse, ['class'=>'form-control border-input','placeholder'=>'adresse du fournisseur']) }}
    <span class="text-danger">{{ $errors->has('adresse') ? $errors->first('adresse') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_fournisseur', 'Statut') }}
    {{ Form::text('statut', $fournisseur->statut, ['class'=>'form-control border-input','placeholder'=>'statut du fournisseur']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>