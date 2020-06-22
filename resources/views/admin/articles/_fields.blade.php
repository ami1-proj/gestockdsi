<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
    {{ Form::label('nom_article', 'nom') }}
    {{ Form::text('nom', $article->nom, ['class'=>'form-control border-input','placeholder'=>'le nom de larticle']) }}
    <span class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('etat') ? 'has-error' : '' }}">
    {{ Form::label('etat_typearticle', 'etat') }}
    {{ Form::text('etat', $article->etat, ['class'=>'form-control border-input','placeholder'=>'letat de lartlicle']) }}
    <span class="text-danger">{{ $errors->has('état') ? $errors->first('état') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('marque') ? 'has-error' : '' }}">
    {{ Form::label('marque_article', 'marque') }}
    {{ Form::text('marque', $article->marque, ['class'=>'form-control border-input','placeholder'=>'marque de larticle']) }}
    <span class="text-danger">{{ $errors->has('marque') ? $errors->first('marque') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('situation') ? 'has-error' : '' }}">
    {{ Form::label('situation_article', 'situation') }}
    {{ Form::text('situation', $article->situation, ['class'=>'form-control border-input','placeholder'=>'situation de larticle']) }}
    <span class="text-danger">{{ $errors->has('situation') ? $errors->first('situation') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_article', 'Statut') }}
    {{ Form::text('statut', $article->statut, ['class'=>'form-control border-input','placeholder'=>'statut de larticle']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>