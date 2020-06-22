@extends('layouts.app_create', \App\Fournisseur::view_attributes_create($fournisseur))

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
