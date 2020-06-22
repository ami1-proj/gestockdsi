@extends('layouts.app_create', \App\Article::view_attributes_create($article))

@section('more_css')
  <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section('more_js')
  <script src="{{ asset('assets/js/select2.min.js') }}"></script>
  @include('marquearticles.add_withmodal_js')
  @include('typearticles.dropdown_list_js')
  @include('fournisseurs.dropdown_list_js')
  @include('marquearticles.dropdown_list_js')
@endsection
