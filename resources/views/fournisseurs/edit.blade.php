@extends('layouts.app_edit', \App\Fournisseur::view_attributes_edit($fournisseur))

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
