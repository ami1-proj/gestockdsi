<?php

use Illuminate\Database\Seeder;
use App\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Zone Centre (Estuaire Et Moyen Ogooue)');
        $this->createNew('Zone Cote-Ouest (Ogooue Maritime)');
        $this->createNew('Zone Nord (Woleu-Ntem Et Ogooue Ivindo)');
        $this->createNew('Zone Sud-Est (Haut Ogooue Et Ogooue Lolo)');
        $this->createNew('Zone Sud-Ouest (Ngounie Et Nyanga)');
    }

    private function createNew($intitule) {
        Zone::create(['intitule' => $intitule, 'statut_id' => 1]);
    }
}
