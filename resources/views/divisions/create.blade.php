@extends('layouts.app_create',[
  'title' => 'divisions',
  'model' => $division,
  'index_route' => 'DivisionController@index',
  'store_route' => 'DivisionController@store',
  'show_route' => 'DivisionController@show',
  'edit_route' => 'DivisionController@edit',
  'destroy_route' => 'DivisionController@destroy',
  'model_fields' => 'divisions.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'divisions.create',
  'breadcrumb_param' => '',
  'canlist' => 'division-list',
  'cancreate' => 'division-create',
  'canedit' => 'division-edit',
  'candelete' => 'division-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
