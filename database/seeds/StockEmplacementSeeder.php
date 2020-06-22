<?php

use Illuminate\Database\Seeder;
use App\StockEmplacement;
use App\Statut;

class StockEmplacementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('A');
        $this->createNew('B');
        $this->createNew('C');
        $this->createNew('D');
        $this->createNew('E');
    }

    private function createNew($emplacement) {
        StockEmplacement::create(['emplacement' => $emplacement,'statut_id' => Statut::default()->first()->id]);
    }
}
