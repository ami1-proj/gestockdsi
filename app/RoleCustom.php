<?php

namespace App;

use Spatie\Permission\Models\Role;

use App\Traits\PermissionTrait;
use App\Traits\AppBaseTrait;
use App\Traits\DefaultTrait;
use App\Traits\RecycleBinTrait;
use App\Traits\ObservantTrait;
use App\Traits\RelationshipsTrait;


class RoleCustom extends Role
{
    use PermissionTrait;
    use AppBaseTrait;
    use DefaultTrait;
    use RecycleBinTrait;
    use ObservantTrait;
    use RelationshipsTrait;

    public static $model_name = 'Role';

    public static $view_folder = 'roles';
    public static $view_fields = 'roles.fields';
    public static $view_table_values = 'roles.table_values';
    public static $view_table_headers = 'roles.table_headers';
    public static $view_morecontrols = ['roles.permissions_control'];
    public static $view_moreforms = [];

    public static $var_name_single = 'role';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'role';
    public static $title_plu = 'roles';

    public static $route_index = 'RoleController@index';
    public static $route_create = 'RoleController@create';
    public static $route_store = 'RoleController@store';
    public static $route_show = 'RoleController@show';
    public static $route_edit = 'RoleController@edit';
    public static $route_update = 'RoleController@update';
    public static $route_destroy = 'RoleController@destroy';

    public static $breadcrumb_index = 'roles';
    public static $breadcrumb_create = 'roles.create';
    public static $breadcrumb_show = 'roles.show';
    public static $breadcrumb_edit = 'roles.edit';

    public static $denomination_field = 'name';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
          'permissions' => ['required'],
      ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
          'name' => ['required','unique:roles,name',],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'name' => ['required','unique:roles,name,'.$model->id,],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    /**
     * Renvoie le Statut de Role.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }
}
