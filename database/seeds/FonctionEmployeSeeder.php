<?php

use Illuminate\Database\Seeder;
use App\FonctionEmploye;
use App\Statut;

class FonctionEmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Directeur Général');
        $this->createNew('Sécrétaire Général');
        $this->createNew('Chef Division');
        $this->createNew('Chef Service');
        $this->createNew('Chef de Centre');

        $this->createNew('Ingénieur Informaticien');
        $this->createNew('Ingénieur Commerciale');
        $this->createNew('Technicien Supérieur');
        $this->createNew('Technicien Commerciale');
        $this->createNew('Prospecteur');
    }

    private function createNew($intitule) {
        FonctionEmploye::create(['intitule' => $intitule,'statut_id' => Statut::default()->first()->id]);
    }
}
