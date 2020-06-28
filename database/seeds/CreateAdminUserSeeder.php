<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Statut;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'rootdev',
        	'email' => 'rootdev@gestockdsi.com',
            'is_local' => true,
            'statut_id' => Statut::actif()->first()->id,
        	'password' => bcrypt('rootdevP@ssw0rd')
        ]);

        $role = Role::create([
            'name' => 'Admin',
            'description' => 'Administrateur Principal du Système',
            'statut_id' => Statut::actif()->first()->id,
        ]);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        // Création du Role default user
        $role_default = Role::create([
            'name' => 'Default User',
            'description' => 'Utilisateur par défaut',
            'statut_id' => Statut::actif()->first()->id,
        ]);
        $permissions_default = Permission::whereIn('name', ['commande-list','commande-create','commande-edit'])->pluck('id','id')->all();
        $role_default->syncPermissions($permissions_default);
    }

}
