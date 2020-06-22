@extends('layouts.app_create',[
  'title' => 'agences',
  'model' => $agence,
  'index_route' => 'AgenceController@index',
  'store_route' => 'AgenceController@store',
  'show_route' => 'AgenceController@show',
  'edit_route' => 'AgenceController@edit',
  'destroy_route' => 'AgenceController@destroy',
  'model_fields' => 'agences.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'agences.create',
  'breadcrumb_param' => '',
  'canlist' => 'agence-list',
  'cancreate' => 'agence-create',
  'canedit' => 'agence-edit',
  'candelete' => 'agence-delete'
])

@section('more_css')
  @include('tags.tags_css')
@endsection

@section('more_js')
  @include('tags.tags_js')
@endsection

