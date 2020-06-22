@extends('layouts.app_create', \App\Departement::view_attributes_create($departement))

@section('more_css')
  <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section('more_js')
  <script src="{{ asset('assets/js/select2.min.js') }}"></script>
  @include('employes.dropdown_list_js')
  @include('departements.dropdown_list_js')
@endsection
