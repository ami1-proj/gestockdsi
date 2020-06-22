<?php

use Illuminate\Database\Seeder;
use App\Stock;
use App\Statut;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Magasin DSI', 1);
    }

    private function createNew($nom,$lieu_id) {
        Stock::create(['nom' => $nom, 'lieu_id' => $lieu_id, 'statut_id' => Statut::default()->first()->id]);
    }
}
