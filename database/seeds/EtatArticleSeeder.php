<?php

use Illuminate\Database\Seeder;
use App\EtatArticle;
use App\Statut;

class EtatArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Nouveau', 1);
        $this->createNew('Ancien', 0);
        $this->createNew('Panne', 0);
    }

    private function createNew($libelle, $is_default) {
        EtatArticle::create(['libelle' => $libelle, 'is_default' => $is_default,'statut_id' => Statut::default()->first()->id]);
    }
}
