@extends('layouts.app')

@section('page')
  TAGS
@endsection

@section('css')
    @include('tags.tags_css')
@endsection
@section('content')
    @include('tags.tags_control')
@endsection
@section('js')
    @include('tags.tags_js')
@endsection
