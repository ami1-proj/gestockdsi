@extends('layouts.app_create',[
  'title' => 'directions',
  'model' => $direction,
  'index_route' => 'DirectionController@index',
  'store_route' => 'DirectionController@store',
  'show_route' => 'DirectionController@show',
  'edit_route' => 'DirectionController@edit',
  'destroy_route' => 'DirectionController@destroy',
  'model_fields' => 'directions.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'directions.create',
  'breadcrumb_param' => '',
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
