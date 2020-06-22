<?php

use Illuminate\Database\Seeder;
use App\Statut;
use App\TypeDepartement;


class TypeDepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createNew('Direction', 'Direction');
      $this->createNew('Division', 'Division');
      $this->createNew('Service', 'Service');
      $this->createNew('Zone', 'Zone');
      $this->createNew('Agence', 'Agence');
    }

    private function createNew($libelle, $tags) {
       TypeDepartement::create(['intitule' => $libelle, 'tags' => $tags,'statut_id' => Statut::default()->first()->id]);
    }
}
