<?php

use Illuminate\Database\Seeder;
use App\Direction;
use App\Statut;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $this->createNew('Direction Général');
          $this->createNew('Secretariat Général');
          $this->createNew('Direction Administrative Et Financiere');
          $this->createNew('Direction Services');
          $this->createNew('Direction Reseaux');
    }

    private function createNew($intitule) {
        Direction::create(['intitule' => $intitule,'statut_id' => Statut::default()->first()->id]);
    }
}
