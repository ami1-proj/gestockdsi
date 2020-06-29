<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="name">Nom</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" placeholder="Nom" value="{{ old('name', $user->name ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="email">Email</label>
    <div class="col-sm-10">
        <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email',  $user->email ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('username') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="name">Login</label>
    <div class="col-sm-10">
        <input name="username" type="text" class="form-control" placeholder="Login" value="{{ old('username', $user->username ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('username') ? $errors->first('username') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_local') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="is_local">Accès Locale</label>
    <div class="col-sm-10">
        <input name="is_local" {{ Auth::user()->can(\App\User::canchange_acceslocal()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="outline-info" data-offstyle="outline-warning" data-toggle="toggle" data-on="Oui" data-off="Non" data-size="xs" {{ $user->is_local == '1' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('is_local') ? $errors->first('is_local') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_ldap') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="is_ldap">Accès LDAP</label>
    <div class="col-sm-10">
        <input name="is_ldap" {{ Auth::user()->can(\App\User::canchange_accesldap()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="outline-info" data-offstyle="outline-warning" data-toggle="toggle" data-on="Oui" data-off="Non" data-size="xs" {{ $user->is_ldap == '1' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('is_ldap') ? $errors->first('is_ldap') : '' }}</small>
    </div>
</div>

@if(isset($user->id))

@else
<div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="password">Mot de Passe</label>
    <div class="col-sm-10">
        <input name="password" type="text" class="form-control" placeholder="Mot de Passe" value="{{ old('password') }}"/>
        <small class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="confirm_password">Confirmation Mot de Passe</label>
    <div class="col-sm-10">
        <input name="confirm_password" type="text" class="form-control" placeholder="Confirmation Mot de Passe " value="{{ old('confirm_password') }}"/>
        <small class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password') : '' }}</small>
    </div>
</div>
@endif

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
      <input name="statut_id" {{ Auth::user()->can(\App\User::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $user->statut->code == 'actif' ? 'checked' : '' }}>
      <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

@csrf
