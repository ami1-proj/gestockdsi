<?php

use Illuminate\Database\Seeder;

class InsertFakeFournisseurs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertion de 20 fournisseurs
        factory(App\Fournisseur::class, 20)->create();
    }
}
