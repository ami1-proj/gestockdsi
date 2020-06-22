@extends('layouts.app_index',[
  'title' => 'services',
  'listvalues' => $services,
  'index_route' => 'ServiceController@index',
  'create_route' => 'ServiceController@create',
  'show_route' => 'ServiceController@show',
  'edit_route' => 'ServiceController@edit',
  'destroy_route' => 'ServiceController@destroy',
  'table_values' => 'services.table_values',
  'table_headers' => 'services.table_headers',
  'breadcrumb_title' => 'services',
  'breadcrumb_param' => '',
  'canlist' => 'service-list',
  'cancreate' => 'service-create',
  'canedit' => 'service-edit',
  'candelete' => 'service-delete'
])

