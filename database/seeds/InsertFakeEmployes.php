<?php

use Illuminate\Database\Seeder;

class InsertFakeEmployes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertion de 10 employés - Service
        factory(App\Employe::class, 10)->states('service')->create();

        // Insertion de 10 employés - Direction
        factory(App\Employe::class, 10)->states('direction')->create();

        // Insertion de 10 employés - Division
        factory(App\Employe::class, 10)->states('division')->create();

        // Insertion de 10 employés - Zone
        factory(App\Employe::class, 10)->states('zone')->create();

        // Insertion de 10 employés - Agence
        factory(App\Employe::class, 10)->states('agence')->create();
    }
}
