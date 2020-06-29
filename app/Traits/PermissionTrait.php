<?php

namespace App\Traits;
use Spatie\Permission\Models\Permission;
use App\AppPermission;

trait PermissionTrait {

   /**
    * Renvoi une liste de noms de permissions a partir d une liste d ids de permissions
    * @param  array $permissions_arr liste d ids de permissions contenu dans un tableau
    * @return string            la liste de noms de permissions ou une variable vide
    */
  public function setPermissions($permissions_arr) : string {
      $permissions = "";

      if ((is_array($permissions_arr)) ) {
          foreach ($permissions_arr as $permission_id) {
              $permission = Permission::find($permission_id);
              if ($permissions == "") {
                  $permissions = "" . $permission->name;
              } else {
                  $permissions = $permissions . "," . $permission->name;
              }
          }

          $permissions = $permissions . "";
      }

      return $permissions;
  }

  /**
   * Renvoi une liste d objet permission a partir d un string de noms de permissions delemites
   * @param  collection $permissions_str liste de noms de permissions delimite
   * @return array           liste d objets permission
   */
  public function getPermissions($permissions_coll)
  {
      $permissions = "";

      $permissions_str = "";

      foreach ($permissions_coll as $perm) {
          if (empty($permissions_str)){
            $permissions_str = $perm->permission_id;
          } else {
            $permissions_str .= ",".$perm->permission_id;
          }
      }

      $permissions_arr = explode(",", $permissions_str);

      //dd($permissions_arr);

      $permissions = Permission::whereIn('id', $permissions_arr)->get()->pluck('name', 'id');

      //dd($permissions);

      return $permissions;
  }

  public function setFormatpermissions($formInput) {
      if (array_key_exists('permissions', $formInput)) {
            $formInput['permissions'] = $this->setpermissions($formInput['permissions']);
      }

      return $formInput;
  }

  private static function getModelPermission($permission_key) {
    $caller_class = get_called_class();
    $caller_class = str_replace("App\\", "", $caller_class);

    if (array_key_exists($caller_class, AppPermission::$list)) {
      $permissions_list = AppPermission::$list[$caller_class];
      if (array_key_exists($permission_key, $permissions_list)) {
        return $permissions_list[$permission_key][0];
      } else {
        return null;
      }
    } else {
      return null;
    }
  }

  public static function canlist() {
    return self::getModelPermission('list');
  }
  public static function cancreate() {
    return self::getModelPermission('create');
  }
  public static function canedit() {
    return self::getModelPermission('edit');
  }
  public static function candelete() {
    return self::getModelPermission('delete');
  }
  public static function canchange_statut() {
    return self::getModelPermission('change_statut');
  }
  public static function canchange_acceslocal() {
      return self::getModelPermission('change_acceslocal');
  }
  public static function canchange_accesldap() {
      return self::getModelPermission('change_accesldap');
  }
  public static function canrestore_trash() {
    return self::getModelPermission('restore_trash');
  }
  public static function candelete_trash() {
    return self::getModelPermission('delete_trash');
  }
  public static function cantraiter() {
    return self::getModelPermission('traiter');
  }
  public static function canaffecter() {
    return self::getModelPermission('affecter');
  }
  public static function canselect_all() {
    return self::getModelPermission('select-all');
  }

  public static function canrestore() {
    return self::getModelPermission('restore');
  }

  public static function canprint() {
    return self::getModelPermission('print');
  }



}
