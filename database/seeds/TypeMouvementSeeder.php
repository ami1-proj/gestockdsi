<?php

use Illuminate\Database\Seeder;
use App\TypeMouvement;
use App\Statut;

class TypeMouvementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Creation Affectation', 1, 'Systeme,Creation');
        $this->createNew('Suppression Affectation', 0, 'Systeme,Suppression');
        $this->createNew('Mise à jour Affectation', 0, 'Modification');
    }

    private function createNew($libelle, $is_default, $tags) {
      TypeMouvement::create(['libelle' => $libelle, 'is_default' => $is_default, 'tags' => $tags,'statut_id' => Statut::default()->first()->id]);
    }
}
