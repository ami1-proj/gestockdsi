<?php

namespace App\Traits;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


trait RoleTrait {

    use StatutTrait;

    public function formatRequestInput(&$request, &$permissions){
        $formInput = $request->all();
        $formInput = $this->setStatutFromRequestInput($formInput);

        $permissions = $formInput['permissions'];

        if (array_key_exists('permissions', $formInput)) {
          unset($formInput['permissions']);
        }

        if (array_key_exists('select_all', $formInput)) {
          unset($formInput['select_all']);
        }

        return $formInput;
    }

    public function getPermissionsFromRequest($request) {
        $formInput = $request->all();
        if (array_key_exists('select_all', $formInput)) {
          $permissions = Permission::pluck('id','id')->all();
          //$request->merge([ 'permissions' => $permissions ]);
        } else {
          if (array_key_exists('permissions', $formInput)) {
            $permissions = $request->input('permissions');
          } else {
            $permissions = [];
          }
        }

        return $permissions;
    }

   /**
    * Renvoi une liste de noms de roles a partir d une liste d ids de roles
    * @param  array $roles_arr liste d ids de roles contenu dans un tableau
    * @return string            la liste de noms de roles ou une variable vide
    */
    public function setRoles($roles_arr) : string {
      $roles = "";

      if ((is_array($roles_arr)) ) {
          foreach ($roles_arr as $role_id) {
              $role = Role::find($role_id);
              if ($roles == "") {
                  $roles = "" . $role->name;
              } else {
                  $roles = $roles . "," . $role->name;
              }
          }

          $roles = $roles . "";
      }

      return $roles;
  }

  /**
   * Renvoi une liste d objet role a partir d un string de noms de roles delemites
   * @param  array $roles_str liste de noms de roles delimite
   * @return array           liste d objets role
   */
  public function getRoles($roles_arr)
  {
      $roles = "";

      $roles_str = "";

      foreach ($roles_arr as $key => $rol) {
          if (empty($roles_str)){
            $roles_str = $key;
          } else {
            $roles_str .= ",".$key;
          }
      }

      $roles_arr = explode(",", $roles_str);

      //dd($roles_arr);

      $roles = Role::whereIn('id', $roles_arr)->get()->pluck('name', 'id');

      //dd($roles);

      return $roles;
  }

  public function setFormatroles($formInput) {
      if (array_key_exists('roles', $formInput)) {
            $formInput['roles'] = $this->setroles($formInput['roles']);
      }

      return $formInput;
  }

}
