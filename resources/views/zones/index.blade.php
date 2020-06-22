@extends('layouts.app_index',[
  'title' => 'zones',
  'listvalues' => $zones,
  'index_route' => 'ZoneController@index',
  'create_route' => 'ZoneController@create',
  'show_route' => 'ZoneController@show',
  'edit_route' => 'ZoneController@edit',
  'destroy_route' => 'ZoneController@destroy',
  'table_values' => 'zones.table_values',
  'table_headers' => 'zones.table_headers',
  'breadcrumb_title' => 'zones',
  'breadcrumb_param' => '',
  'canlist' => 'zone-list',
  'cancreate' => 'zone-create',
  'canedit' => 'zone-edit',
  'candelete' => 'zone-delete'
])

