@extends('layouts.app_edit', \App\Employe::view_attributes_edit($employe))

@section('more_css')
  <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section('more_js')
  <script src="{{ asset('assets/js/select2.min.js') }}"></script>
  @include('fonctionemployes.add_withmodal_js')
  @include('departements.dropdown_list_js')
  @include('fonctionemployes.dropdown_list_js')
@endsection
