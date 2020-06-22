<?php

use Illuminate\Database\Seeder;
use App\Statut;
use App\TypeAffectation;

class TypeAffectationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
           $this->createNew('Stock', 'App\Stock', 1, 'Stock');
           $this->createNew('Employe', 'App\Employe', 0, 'Employe');
           $this->createNew('Departement', 'App\Departement', 0, 'Departement');
           $this->createNew('Supprime', 'Supprime', 0, 'Supprime');
     }

     private function createNew($libelle, $object_class_name, $is_default, $tags) {
        TypeAffectation::create(['libelle' => $libelle, 'object_class_name' => $object_class_name, 'is_default' => $is_default, 'tags' => $tags,'statut_id' => Statut::default()->first()->id]);
     }
}
