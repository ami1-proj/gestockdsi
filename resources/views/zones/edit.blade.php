@extends('layouts.app_edit',[
  'title' => 'zone',
  'model' => $zone,
  'modelname' => $zone->nom,
  'modeltype' => 'du zone',
  'index_route' => 'ZoneController@index',
  'update_route' => 'ZoneController@update',
  'show_route' => 'ZoneController@show',
  'edit_route' => 'ZoneController@edit',
  'destroy_route' => 'ZoneController@destroy',
  'model_fields' => 'zones.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'zones.edit',
  'breadcrumb_param' => $zone->id,
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
