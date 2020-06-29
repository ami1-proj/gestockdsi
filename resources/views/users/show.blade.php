@extends('layouts.app_show', \App\User::view_attributes_show($user))

@section('show_details')

  <dl class="row">
      <dt class="col-sm-3">Id</dt>
      <dd class="col-sm-9">{{ $user->id }}</dd>

      <dt class="col-sm-3">Nom</dt>
      <dd class="col-sm-9">{{ $user->name ?? '' }}</dd>

      <dt class="col-sm-3">Email</dt>
      <dd class="col-sm-9">{{ $user->email ?? '' }}</dd>

      <dt class="col-sm-3">Login</dt>
      <dd class="col-sm-9">{{ $user->username ?? '' }}</dd>

      <dt class="col-sm-3">Accès Local</dt>
      <dd class="col-sm-9">
          <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $user->is_local ? 'checked="checked"' : '' }}/>
      </dd>

      <dt class="col-sm-3">Accès LDAP</dt>
      <dd class="col-sm-9">
          <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $user->is_ldap ? 'checked="checked"' : '' }}/>
      </dd>

      <dt class="col-sm-3">Statut</dt>
      <dd class="col-sm-9">
        <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $user->statut->code == 'actif' ? 'checked' : '' }}>
      </dd>

      <dt class="col-sm-3">Roles</dt>
      <dd class="col-sm-9">
        @if(!empty($user->getRoleNames()))
          @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
          @endforeach
        @endif
      </dd>

      @include('recyclebin._details', ['currval' => $user])
  </dl>

@endsection
