@extends('layouts.app_edit', \App\RoleCustom::view_attributes_edit($role))

@section('more_css')
  @include('roles.permissions_css')
@endsection

@section('more_js')
  @include('roles.permissions_js')
@endsection
