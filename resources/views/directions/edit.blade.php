@extends('layouts.app_edit',[
  'title' => ' direction',
  'model' => $direction,
  'modelname' => $direction->nom,
  'modeltype' => 'du direction',
  'index_route' => 'DirectionController@index',
  'update_route' => 'DirectionController@update',
  'show_route' => 'DirectionController@show',
  'edit_route' => 'DirectionController@edit',
  'destroy_route' => 'DirectionController@destroy',
  'model_fields' => 'directions.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'directions.edit',
  'breadcrumb_param' => $direction->id,
  'canlist' => 'direction-list',
  'cancreate' => 'direction-create',
  'canedit' => 'direction-edit',
  'candelete' => 'direction-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
