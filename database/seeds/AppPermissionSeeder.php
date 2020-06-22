<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\AppPermission;

class AppPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (AppPermission::$list as $model_class => $permissions) {
        foreach ($permissions as $permission_key => $permission) {
          Permission::create(['name' => $permission[0], 'level' => $permission[1]]);
        }
      }
    }
}
