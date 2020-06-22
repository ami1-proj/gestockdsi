@extends('layouts.app_create', \App\User::view_attributes_create($user))

@section('more_css')
  @include('users.roles_css')
@endsection

@section('more_js')
  @include('users.roles_js')
@endsection
