<?php

use Illuminate\Database\Seeder;
use App\StockLieu;
use App\Statut;

class StockLieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Libreville CENACOM');
        $this->createNew('Libreville NEUF ETAGES');
    }

    private function createNew($nom) {
        StockLieu::create(['nom' => $nom,'statut_id' => Statut::default()->first()->id]);
    }
}
