@extends('layouts.app_create',[
  'title' => 'services',
  'model' => $service,
  'index_route' => 'ServiceController@index',
  'store_route' => 'ServiceController@store',
  'show_route' => 'ServiceController@show',
  'edit_route' => 'ServiceController@edit',
  'destroy_route' => 'ServiceController@destroy',
  'model_fields' => 'services.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'services.create',
  'breadcrumb_param' => '',
  'canlist' => 'service-list',
  'cancreate' => 'service-create',
  'canedit' => 'service-edit',
  'candelete' => 'service-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
