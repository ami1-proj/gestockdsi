@extends('layouts.app_create',[
  'title' => 'zones',
  'model' => $zone,
  'index_route' => 'ZoneController@index',
  'store_route' => 'ZoneController@store',
  'show_route' => 'ZoneController@show',
  'edit_route' => 'ZoneController@edit',
  'destroy_route' => 'ZoneController@destroy',
  'model_fields' => 'zones.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'zones.create',
  'breadcrumb_param' => '',
  'canlist' => 'zone-list',
  'cancreate' => 'zone-create',
  'canedit' => 'zone-edit',
  'candelete' => 'zone-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection
