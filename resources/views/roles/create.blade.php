@extends('layouts.app_create', \App\RoleCustom::view_attributes_create($role))

@section('more_css')
  @include('roles.permissions_css')
@endsection

@section('more_js')
  @include('roles.permissions_js')
@endsection
