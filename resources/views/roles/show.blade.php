@extends('layouts.app_show', \App\RoleCustom::view_attributes_show($role))

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">Id</dt>
    <dd class="col-sm-9">{{ $role->id }}</dd>

    <dt class="col-sm-3">Nom</dt>
    <dd class="col-sm-9">{{ $role->name }}</dd>

    <dt class="col-sm-3">Description</dt>
    <dd class="col-sm-9">{{ $role->description }}</dd>

    <dt class="col-sm-3">Statut</dt>
    <dd class="col-sm-9">
      <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $role->statut->code == 'actif' ? 'checked' : '' }}>
    </dd>

    <dt class="col-sm-3">Permission(s)</dt>
    <dd class="col-sm-9">
      @if(!empty($rolePermissions))
        @foreach($rolePermissions as $v)
          @include('permissions.display', ['perm'=>$v])
        @endforeach
      @endif
    </dd>
</dl>

@endsection
