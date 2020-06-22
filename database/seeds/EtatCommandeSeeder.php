<?php

use Illuminate\Database\Seeder;
use App\EtatCommande;
use App\Statut;

class EtatCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('attende de validation', 1);
        $this->createNew('validée', 0);
        $this->createNew('rejettée', 0);
    }

    private function createNew($libelle, $is_default) {
        EtatCommande::create(['libelle' => $libelle, 'is_default' => $is_default,'statut_id' => Statut::default()->first()->id]);
    }
}
