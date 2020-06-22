
<div class="form-group {{ $errors->has('matricule') ? 'has-error' : '' }}">
    {{ Form::label('matricule_employe', 'matricule') }}
    {{ Form::text('matricule', $employe->matriucle, ['class'=>'form-control border-input','placeholder'=>'matricule de lemploye']) }}
    <span class="text-danger">{{ $errors->has('nom') ? $errors->first('matricule') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
    {{ Form::label('nom_employe', 'nom') }}
    {{ Form::text('nom', $employe->nom, ['class'=>'form-control border-input','placeholder'=>'le nom de lemploye']) }}
    <span class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('prénom') ? 'has-error' : '' }}">
    {{ Form::label('prénom_employe', 'prenom') }}
    {{ Form::text('prénom', $employe->etat, ['class'=>'form-control border-input','placeholder'=>'le prénom de lemploye']) }}
    <span class="text-danger">{{ $errors->has('prénom') ? $errors->first('prénom') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{ Form::label('email_employe', 'email') }}
    {{ Form::text('email', $employe->email, ['class'=>'form-control border-input','placeholder'=>'email de lemploye']) }}
    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>

</div>


<div class="form-group {{ $errors->has('titre') ? 'has-error' : '' }}">
    {{ Form::label('titre_employe', 'titre') }}
    {{ Form::text('titre', $employe->titre, ['class'=>'form-control border-input','placeholder'=>'le titre de lemploye']) }}
    <span class="text-danger">{{ $errors->has('titre') ? $errors->first('titre') : '' }}</span>
</div>


<div class="form-group {{ $errors->has('télephone') ? 'has-error' : '' }}">
    {{ Form::label('télephone_employe', 'téléphone') }}
    {{ Form::text('télephone', $employe->téléphone, ['class'=>'form-control border-input','placeholder'=>'telephone de lemploye']) }}
    <span class="text-danger">{{ $errors->has('téléphone') ? $errors->first('téléphone') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('adresse') ? 'has-error' : '' }}">
    {{ Form::label('adresse_téléphone', 'adresse') }}
    {{ Form::text('adresse', $employe->adresse, ['class'=>'form-control border-input','placeholder'=>'adresse de lemploye']) }}
    <span class="text-danger">{{ $errors->has('adresse') ? $errors->first('adresse') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('statut') ? 'has-error' : '' }}">
    {{ Form::label('Statut_employe', 'Statut') }}
    {{ Form::text('statut', $employe->statut, ['class'=>'form-control border-input','placeholder'=>'statut de lenmploye']) }}
    <span class="text-danger">{{ $errors->has('statut') ? $errors->first('statut') : '' }}</span>
</div>