@extends('layouts.app_edit',[
  'title' => 'divisions',
  'model' => $division,
  'modelname' => $division->nom,
  'modeltype' => 'du division',
  'index_route' => 'DivisionController@index',
  'update_route' => 'DivisionController@update',
  'show_route' => 'DivisionController@show',
  'edit_route' => 'DivisionController@edit',
  'destroy_route' => 'DivisionController@destroy',
  'model_fields' => 'divisions.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'divisions.edit',
  'breadcrumb_param' => $division->id,
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
