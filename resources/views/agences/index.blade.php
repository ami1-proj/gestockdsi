@extends('layouts.app_index',[
  'title' => 'agences',
  'listvalues' => $agences,
  'index_route' => 'AgenceController@index',
  'create_route' => 'AgenceController@create',
  'show_route' => 'AgenceController@show',
  'edit_route' => 'AgenceController@edit',
  'destroy_route' => 'AgenceController@destroy',
  'table_values' => 'agences.table_values',
  'table_headers' => 'agences.table_headers',
  'breadcrumb_title' => 'agences',
  'breadcrumb_param' => '',
  'canlist' => 'agence-list',
  'cancreate' => 'agence-create',
  'canedit' => 'agence-edit',
  'candelete' => 'agence-delete'
])

