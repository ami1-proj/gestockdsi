<?php

use Illuminate\Database\Seeder;
use App\Agence;

class AgenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createNew('Agence Commerciale Okala', 1);
      $this->createNew('Agence Commerciale Grands Comptes Et Entreprises', 1);
      $this->createNew('Agence Commerciale De Nzeng Ayong', 1);
      $this->createNew('Agence Commerciale D’owendo', 1);
      $this->createNew('Box Super Ckdo Owendo', 1);
      $this->createNew('Agence Principale', 1);
      $this->createNew('Agence Commerciale De Sainte Marie', 1);
      $this->createNew('Agence Commerciale De Sogalivre', 1);
      $this->createNew('Agence Commerciale Vente Indirecte', 1);
      $this->createNew('Agence Commerciale Mont-Bouet', 1);
      $this->createNew('Agence Commerciale PK 8', 1);
      $this->createNew('Agence Commerciale FTTH', 1);
      $this->createNew('Agence Commerciale IFG', 1);
      $this->createNew('Agence Commerciale Awendje', 1);
      $this->createNew('Agence Commerciale Renovation', 1);
      $this->createNew('Agence Commerciale De Lambarene', 1);
      $this->createNew('Centre De Saisie Et Archivage', 1);

      $this->createNew('Agence Commerciale De Port- Gentil', 2);
      $this->createNew('Agence Commerciale Gamba', 2);
      $this->createNew('Centre Technique De Port - Gentil', 2);
      $this->createNew('Centre Technique De Gamba', 2);

      $this->createNew('Agence Commerciale D’Oyem', 3);
      $this->createNew('Agence Commerciale De Bitam', 3);
      $this->createNew('Agence Commerciale De Makokou', 3);
      $this->createNew('Centre Technique D’Oyem', 3);
      $this->createNew('Centre Technique De Makokou', 3);
      $this->createNew('Site Technique Bitam', 3);
      $this->createNew('Centre Technique De Booue', 3);
      $this->createNew('Centre Technique De Ndjole', 3);
      $this->createNew('Agence Commerciale De Franceville', 4);
      $this->createNew('Agence Commerciale De Moanda', 4);
      $this->createNew('Agence Commerciale De Koulamoutou', 4);
      $this->createNew('Centre Technique De Franceville', 4);
      $this->createNew('Centre Technique De Moanda', 4);
      $this->createNew('Centre Technique De Koulamoutou', 4);
      $this->createNew('Site Technique De Lastourville', 4);
      $this->createNew('Site Technique De Lastourville', 4);
      $this->createNew('Agence Commerciale De Mouila', 5);
      $this->createNew('Agence Commerciale De Tchibanga', 5);
      $this->createNew('Centre Technique De Mouila', 5);
      $this->createNew('Centre Technique De Tchibanga', 5);
      $this->createNew('Centre Technique Mandji', 5);
    }

    private function createNew($intitule,$zone_id) {
        Agence::create(['intitule' => $intitule, 'zone_id' => $zone_id,'statut_id' => 1]);
    }
}
