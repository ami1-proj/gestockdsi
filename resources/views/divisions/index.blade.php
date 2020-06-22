@extends('layouts.app_index',[
  'title' => 'divisions',
  'listvalues' => $divisions,
  'index_route' => 'DivisionController@index',
  'create_route' => 'DivisionController@create',
  'show_route' => 'DivisionController@show',
  'edit_route' => 'DivisionController@edit',
  'destroy_route' => 'DivisionController@destroy',
  'table_values' => 'divisions.table_values',
  'table_headers' => 'divisions.table_headers',
  'breadcrumb_title' => 'divisions',
  'breadcrumb_param' => '',
  'canlist' => 'division-list',
  'cancreate' => 'division-create',
  'canedit' => 'division-edit',
  'candelete' => 'division-delete'
])

