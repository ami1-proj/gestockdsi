<?php

use Illuminate\Database\Seeder;
use App\Division;
use App\Statut;

class DivisionSeeder_old extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $this->createNew(' ',1);
          $this->createNew('Division Controle General et Audit',1);
          $this->createNew(' ',2);
          $this->createNew('Division Des Ressources Humaines',2);
          $this->createNew('Division Reglementation Et Affaire Juridique',2);
          $this->createNew('Division Communication Institutionnelle Et Relations Publiques',2);
          $this->createNew(' ',3);
          $this->createNew('Division Finance',3);
          $this->createNew('Division Achats Et Logistique',3);
          $this->createNew(' ',4);
          $this->createNew('Division Ventes',4);
          $this->createNew('Division Marketing',4);
          $this->createNew('Division International Et Interconnexions',4);
          $this->createNew('Division Service Clients',4);
          $this->createNew(' ',5);
          $this->createNew('Division Exploitation Et Maintenance',5);
          $this->createNew('Division Ingenierie Et Deploiement',5);
          $this->createNew('Division Systemes D’information',5);
          $this->createNew(' ',6);
          $this->createNew(' ',7);
          $this->createNew(' ',8);
          $this->createNew(' ',9);
          $this->createNew(' ',10);
    }

    private function createNew($intitule,$direction_id) {
        Division::create(['intitule' => $intitule, 'direction_id' => $direction_id,'statut_id' => Statut::default()->first()->id]);
    }
}
