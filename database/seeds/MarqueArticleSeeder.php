<?php

use Illuminate\Database\Seeder;
use App\MarqueArticle;
use App\Statut;

class MarqueArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Hp');
        $this->createNew('Dell');
        $this->createNew('Xerox');
        $this->createNew('Toshiba');
        $this->createNew('Canon');
        $this->createNew('SAMSUNG');
    }

    private function createNew($nom) {
        MarqueArticle::create(['nom' => $nom,'statut_id' => Statut::default()->first()->id]);
    }
}
