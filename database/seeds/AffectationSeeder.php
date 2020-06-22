<?php

use Illuminate\Database\Seeder;
use App\Affectation;
use App\Statut;

class AffectationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createNew('Stock Initial',1,1,'Systeme');
    }

    private function createNew($objet,$type_affectation_id,$stock_id,$tags) {
      Affectation::create([
      	'objet' => $objet,
      	'date_debut' => now(),
      	'type_affectation_id' => $type_affectation_id,
      	'beneficiaire_id' => $stock_id,
        'tags' => $tags,
      	'statut_id' => Statut::default()->first()->id
      ]);
    }
}
