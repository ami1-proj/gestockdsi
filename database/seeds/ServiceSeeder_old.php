<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\Statut;

class ServiceSeeder_old extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $this->createNew(' ', 1);
          $this->createNew(' ', 2);
          $this->createNew('Service Controle General', 2);
          $this->createNew(' ', 3);
          $this->createNew(' ', 4);
          $this->createNew('Service Developpement Des RH', 4);
          $this->createNew('Service Gestion Des RH', 4);
          $this->createNew(' ', 5);
          $this->createNew('Service Affaires Juridiques', 5);
          $this->createNew('Service Reglementation', 5);
          $this->createNew(' ', 6);
          $this->createNew('Service Communication Institutionnelle', 6);
          $this->createNew('Service Relations Publiques', 6);
          $this->createNew(' ', 7);
          $this->createNew(' ', 8);
          $this->createNew('Service Comptabilite', 8);
          $this->createNew('Service Comptabilite Analytique', 8);
          $this->createNew('Service Controle De Gestion', 8);
          $this->createNew('Service Tresorerie', 8);
          $this->createNew(' ', 9);
          $this->createNew('Service Achats', 9);
          $this->createNew('Service Logistique Et Foncier', 9);
          $this->createNew('Centre National De Magasinage', 9);
          $this->createNew(' ', 10);
          $this->createNew(' ', 11);
          $this->createNew('Service Animation Commerciale Et Merchandising', 11);
          $this->createNew('Service Ventes', 11);
          $this->createNew('Service Ventes Indirectes', 11);
          $this->createNew('Service Ventes Entreprises', 11);
          $this->createNew('Service Sav Et Approvisionnement', 11);
          $this->createNew(' ', 12);
          $this->createNew('Service Communication Produits', 12);
          $this->createNew('Service Marketing', 12);
          $this->createNew('Service Veille Et Etudes', 12);
          $this->createNew('Service Offres Fixe Et Entreprises', 12);
          $this->createNew(' ', 13);
          $this->createNew('Service Interconnexion Internationale Et Roaming', 13);
          $this->createNew('Service Interconnexion Nationale', 13);
          $this->createNew(' ', 14);
          $this->createNew('Centre D’appels', 14);
          $this->createNew('Centre Traitement Des Reclamations', 14);
          $this->createNew('Service Facturation', 14);
          $this->createNew('Service Recouvrement', 14);
          $this->createNew('Service Relation Clients', 14);
          $this->createNew(' ', 15);
          $this->createNew(' ', 16);
          $this->createNew('Service Exploitation Et Maintenance Reseaux Fixes', 16);
          $this->createNew('Service Maintenance Environnement Technique', 16);
          $this->createNew('Service Installation Et SAV', 16);
          $this->createNew('Service Maintenance Radio', 16);
          $this->createNew('Service Maintenance Transmission Et IP', 16);
          $this->createNew('Service NOC', 16);
          $this->createNew('Service Maintenance Core Et RVA', 16);
          $this->createNew('Site Technique Redondance Nss Gros-Bouquet', 16);
          $this->createNew('Centre Approvisionnement', 16);
          $this->createNew('Centre Bureau D’etudes', 16);
          $this->createNew('Centre De Production', 16);
          $this->createNew('Centre D’exploitation MSAN', 16);
          $this->createNew('Centre Environnement CENACOM', 16);
          $this->createNew('Centre Fichier Technique D’abonnes', 16);
          $this->createNew('Centre International Du Cable Sous-Marin Sat 3', 16);
          $this->createNew('Centre National Des Transmissions Par Satellite De Nkoltang', 16);
          $this->createNew('Centre National De Production Et Internet', 16);
          $this->createNew('Centre National De Supervision', 16);
          $this->createNew('Centre National Des Transmissions Hertziennes Et Optiques De Nkologoum', 16);
          $this->createNew('Centre National Environnement Technique', 16);
          $this->createNew('Centre National Et International Fixe', 16);
          $this->createNew('Centre National Maintenance BSS Mobile', 16);
          $this->createNew('Centre NSS Mobile Et Transit', 16);
          $this->createNew('Centre Reseau Intelligent IN', 16);
          $this->createNew('Centre Technique Gros-Bouquet', 16);
          $this->createNew('Centre Technique Agondje', 16);
          $this->createNew('Centre Technique CENACOM', 16);
          $this->createNew('Centre Technique Mindoube', 16);
          $this->createNew('Centre Technique Nzeng-Ayong', 16);
          $this->createNew('Centre Technique De Lambarene', 16);
          $this->createNew(' ', 17);
          $this->createNew('Service Deploiement Acces Et Transmission', 17);
          $this->createNew('Service Deploiement Du Reseau Core & PFS', 17);
          $this->createNew('Service Ingenierie Et Performances', 17);
          $this->createNew('Service Reseaux D’entreprises', 17);
          $this->createNew(' ', 18);
          $this->createNew('Service Integration Et Support', 18);
          $this->createNew('Service SI Metier', 18);
          $this->createNew('Service SI Production', 18);
          $this->createNew(' ', 19);
          $this->createNew('Agence Commerciale Okala', 19);
          $this->createNew('Agence Commerciale Grands Comptes Et Entreprises', 19);
          $this->createNew('Agence Commerciale De Nzeng Ayong', 19);
          $this->createNew('Agence Commerciale D’owendo', 19);
          $this->createNew('Box Super Ckdo Owendo', 19);
          $this->createNew('Agence Principale', 19);
          $this->createNew('Agence Commerciale De Sainte Marie', 19);
          $this->createNew('Agence Commerciale De Sogalivre', 19);
          $this->createNew('Agence Commerciale Vente Indirecte', 19);
          $this->createNew('Agence Commerciale Mont-Bouet', 19);
          $this->createNew('Agence Commerciale PK 8', 19);
          $this->createNew('Agence Commerciale FTTH', 19);
          $this->createNew('Agence Commerciale IFG', 19);
          $this->createNew('Agence Commerciale Awendje', 19);
          $this->createNew('Agence Commerciale Renovation', 19);
          $this->createNew('Agence Commerciale De Lambarene', 19);
          $this->createNew('Centre De Saisie Et Archivage', 19);
          $this->createNew(' ', 20);
          $this->createNew('Agence Commerciale De Port- Gentil', 20);
          $this->createNew('Agence Commerciale Gamba', 20);
          $this->createNew('Centre Technique De Port - Gentil', 20);
          $this->createNew('Centre Technique De Gamba', 20);
          $this->createNew(' ', 21);
          $this->createNew('Agence Commerciale D’Oyem', 21);
          $this->createNew('Agence Commerciale De Bitam', 21);
          $this->createNew('Agence Commerciale De Makokou', 21);
          $this->createNew('Centre Technique D’Oyem', 21);
          $this->createNew('Centre Technique De Makokou', 21);
          $this->createNew('Site Technique Bitam', 21);
          $this->createNew('Centre Technique De Booue', 21);
          $this->createNew('Centre Technique De Ndjole', 21);
          $this->createNew(' ', 22);
          $this->createNew('Agence Commerciale De Franceville', 22);
          $this->createNew('Agence Commerciale De Moanda', 22);
          $this->createNew('Agence Commerciale De Koulamoutou', 22);
          $this->createNew('Centre Technique De Franceville', 22);
          $this->createNew('Centre Technique De Moanda', 22);
          $this->createNew('Centre Technique De Koulamoutou', 22);
          $this->createNew('Site Technique De Lastourville', 22);
          $this->createNew('Site Technique De Lastourville', 22);
          $this->createNew(' ', 22);
          $this->createNew('Agence Commerciale De Mouila', 22);
          $this->createNew('Agence Commerciale De Tchibanga', 22);
          $this->createNew('Centre Technique De Mouila', 22);
          $this->createNew('Centre Technique De Tchibanga', 22);
          $this->createNew('Centre Technique Mandji', 22);
    }

    private function createNew($intitule,$division_id) {
        Service::create(['intitule' => $intitule, 'division_id' => $division_id,'statut_id' => Statut::default()->first()->id]);
    }
}
