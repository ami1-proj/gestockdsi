<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\Statut;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Service Controle General', 1);
        $this->createNew('Service Audit', 1);
        
        $this->createNew('Service Developpement Des RH', 2);
        $this->createNew('Service Gestion Des RH', 2);

        $this->createNew('Service Affaires Juridiques', 3);
        $this->createNew('Service Reglementation', 3);

        $this->createNew('Service Communication Institutionnelle', 4);
        $this->createNew('Service Relations Publiques', 4);

        $this->createNew('Service Comptabilite', 5);
        $this->createNew('Service Comptabilite Analytique', 5);
        $this->createNew('Service Controle De Gestion', 5);
        $this->createNew('Service Tresorerie', 5);

        $this->createNew('Service Achats', 6);
        $this->createNew('Service Logistique Et Foncier', 6);
        $this->createNew('Centre National De Magasinage', 6);

        $this->createNew('Service Animation Commerciale Et Merchandising', 7);
        $this->createNew('Service Ventes', 7);
        $this->createNew('Service Ventes Indirectes', 7);
        $this->createNew('Service Ventes Entreprises', 7);
        $this->createNew('Service Sav Et Approvisionnement', 7);

        $this->createNew('Service Communication Produits', 8);
        $this->createNew('Service Marketing', 8);
        $this->createNew('Service Veille Et Etudes', 8);
        $this->createNew('Service Offres Fixe Et Entreprises', 8);

        $this->createNew('Service Interconnexion Internationale Et Roaming', 9);
        $this->createNew('Service Interconnexion Nationale', 9);

        $this->createNew('Centre D’appels', 10);
        $this->createNew('Centre Traitement Des Reclamations', 10);
        $this->createNew('Service Facturation', 10);
        $this->createNew('Service Recouvrement', 10);
        $this->createNew('Service Relation Clients', 10);

        $this->createNew('Service Exploitation Et Maintenance Reseaux Fixes', 11);
        $this->createNew('Service Maintenance Environnement Technique', 11);
        $this->createNew('Service Installation Et SAV', 11);
        $this->createNew('Service Maintenance Radio', 11);
        $this->createNew('Service Maintenance Transmission Et IP', 11);
        $this->createNew('Service NOC', 11);
        $this->createNew('Service Maintenance Core Et RVA', 11);
        $this->createNew('Site Technique Redondance Nss Gros-Bouquet', 11);
        $this->createNew('Centre Approvisionnement', 11);
        $this->createNew('Centre Bureau D’etudes', 11);
        $this->createNew('Centre De Production', 11);
        $this->createNew('Centre D’exploitation MSAN', 11);
        $this->createNew('Centre Environnement CENACOM', 11);
        $this->createNew('Centre Fichier Technique D’abonnes', 11);
        $this->createNew('Centre International Du Cable Sous-Marin Sat 3', 11);
        $this->createNew('Centre National Des Transmissions Par Satellite De Nkoltang', 11);
        $this->createNew('Centre National De Production Et Internet', 11);
        $this->createNew('Centre National De Supervision', 11);
        $this->createNew('Centre National Des Transmissions Hertziennes Et Optiques De Nkologoum', 11);
        $this->createNew('Centre National Environnement Technique', 11);
        $this->createNew('Centre National Et International Fixe', 11);
        $this->createNew('Centre National Maintenance BSS Mobile', 11);
        $this->createNew('Centre NSS Mobile Et Transit', 11);
        $this->createNew('Centre Reseau Intelligent IN', 11);
        $this->createNew('Centre Technique Gros-Bouquet', 11);
        $this->createNew('Centre Technique Agondje', 11);
        $this->createNew('Centre Technique CENACOM', 11);
        $this->createNew('Centre Technique Mindoube', 11);
        $this->createNew('Centre Technique Nzeng-Ayong', 11);
        $this->createNew('Centre Technique De Lambarene', 11);

        $this->createNew('Service Deploiement Acces Et Transmission', 12);
        $this->createNew('Service Deploiement Du Reseau Core & PFS', 12);
        $this->createNew('Service Ingenierie Et Performances', 12);
        $this->createNew('Service Reseaux D’entreprises', 12);

        $this->createNew('Service Integration Et Support', 13);
        $this->createNew('Service SI Metier', 13);
        $this->createNew('Service SI Production', 13);
    }

    private function createNew($intitule,$division_id) {
        Service::create(['intitule' => $intitule, 'division_id' => $division_id,'statut_id' => Statut::default()->first()->id]);
    }
}
