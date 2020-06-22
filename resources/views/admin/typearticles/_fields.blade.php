<div class="form-group {{ $errors->has('libelle') ? 'has-error' : '' }}">
    {{ Form::label('libelle_typearticle', 'Libelle') }}
    {{ Form::text('libelle', $typearticle->libelle, ['class'=>'form-control border-input','placeholder'=>'Libelle du Type Article']) }}
    <span class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('Description_typearticle', 'Description') }}
    {{ Form::textarea('description', $typearticle->description, ['class'=>'form-control border-input','placeholder'=>'Description du Type Article']) }}
    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_typearticle', 'Statut') }}
    {{ Form::text('statut', $typearticle->statut, ['class'=>'form-control border-input','placeholder'=>'statut du Type Article']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
    {{ Form::label('Image_typearticle', 'Image') }}
    {{ Form::file('image', $typearticle->image, ['class'=>'form-control border-input','placeholder'=>'image du Type Article']) }}
    <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
</div>