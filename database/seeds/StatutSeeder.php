<?php

use Illuminate\Database\Seeder;
use App\Statut;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Actif', 'actif', 1);
        $this->createNew('Inactif', 'inactif', 0);
    }

    private function createNew($libelle, $code, $is_default) {
        Statut::create(['libelle' => $libelle, 'code' => $code, 'is_default' => $is_default]);
    }
}
