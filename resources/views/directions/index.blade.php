@extends('layouts.app_index',[
  'title' => 'directions',
  'listvalues' => $directions,
  'index_route' => 'DirectionController@index',
  'create_route' => 'DirectionController@create',
  'show_route' => 'DirectionController@show',
  'edit_route' => 'DirectionController@edit',
  'destroy_route' => 'DirectionController@destroy',
  'table_values' => 'directions.table_values',
  'table_headers' => 'directions.table_headers',
  'breadcrumb_title' => 'directions',
  'breadcrumb_param' => '',
  'canlist' => 'direction-list',
  'cancreate' => 'direction-create',
  'canedit' => 'direction-edit',
  'candelete' => 'direction-delete'
])

