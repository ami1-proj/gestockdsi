@extends('layouts.app_edit',[
  'title' => 'agence',
  'model' => $agence,
  'modelname' => $agence->nom,
  'modeltype' => 'du agence',
  'index_route' => 'AgenceController@index',
  'update_route' => 'AgenceController@update',
  'show_route' => 'AgenceController@show',
  'edit_route' => 'AgenceController@edit',
  'destroy_route' => 'AgenceController@destroy',
  'model_fields' => 'agences.fields',
  'morecontrols' => ['tags.tags_control'],
  'breadcrumb_title' => 'agences.edit',
  'breadcrumb_param' => $agence->id,
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
