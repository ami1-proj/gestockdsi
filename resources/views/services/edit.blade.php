@extends('layouts.app_edit',[
  'title' => ' service',
  'model' => $service,
  'modelname' => $service->nom,
  'modeltype' => 'du service',
  'index_route' => 'ServiceController@index',
  'update_route' => 'ServiceController@update',
  'show_route' => 'ServiceController@show',
  'edit_route' => 'ServiceController@edit',
  'destroy_route' => 'ServiceController@destroy',
  'model_fields' => 'services.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'services.edit',
  'breadcrumb_param' => $service->id,
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
