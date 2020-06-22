<?php

use Illuminate\Database\Seeder;
use App\Departement;
use App\TypeDepartement;
use App\Statut;

use App\Traits\DepartementTrait;


class DepartementSeeder extends Seeder
{
    use DepartementTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Les Directions

        /*1*/$this->createNew('Direction Général', 'Direction', null);
        /*2*/$this->createNew('Secretariat Général', 'Direction', null);
        /*3*/$this->createNew('Direction Administrative Et Financiere', 'Direction', null);
        /*4*/$this->createNew('Direction Services', 'Direction', null);
        /*5*/$this->createNew('Direction Reseaux', 'Direction', null);

        // Les Divisions

        /*6*/$this->createNew('Division Controle General et Audit', 'Division', 1);

        /*7*/$this->createNew('Division Des Ressources Humaines', 'Division', 2);
        /*8*/$this->createNew('Division Reglementation Et Affaire Juridique', 'Division', 2);
        /*9*/$this->createNew('Division Communication Institutionnelle Et Relations Publiques', 'Division', 2);

        /*10*/$this->createNew('Division Finance', 'Division', 3);
        /*11*/$this->createNew('Division Achats Et Logistique', 'Division', 3);

        /*12*/$this->createNew('Division Ventes', 'Division', 4);
        /*13*/$this->createNew('Division Marketing', 'Division', 4);
        /*14*/$this->createNew('Division International Et Interconnexions', 'Division', 4);
        /*15*/$this->createNew('Division Service Clients', 'Division', 4);

        /*16*/$this->createNew('Division Exploitation Et Maintenance', 'Division', 5);
        /*17*/$this->createNew('Division Ingenierie Et Deploiement', 'Division', 5);
        /*18*/$this->createNew('Division Systemes D’information', 'Division', 5);

        // Les Services

        /*19*/$this->createNew('Service Controle General', 'Service', 6);
        /*20*/$this->createNew('Service Audit', 'Service', 6);

        /*21*/$this->createNew('Service Developpement Des RH', 'Service', 7);
        /*22*/$this->createNew('Service Gestion Des RH', 'Service', 7);

        /*23*/$this->createNew('Service Affaires Juridiques', 'Service', 8);
        /*24*/$this->createNew('Service Reglementation', 'Service', 8);

        /*25*/$this->createNew('Service Communication Institutionnelle', 'Service', 9);
        /*26*/$this->createNew('Service Relations Publiques', 'Service', 9);

        /*27*/$this->createNew('Service Comptabilite', 'Service', 10);
        /*28*/$this->createNew('Service Comptabilite Analytique', 'Service', 10);
        /*29*/$this->createNew('Service Controle De Gestion', 'Service', 10);
        /*30*/$this->createNew('Service Tresorerie', 'Service', 10);

        /*31*/$this->createNew('Service Achats', 'Service', 11);
        /*32*/$this->createNew('Service Logistique Et Foncier', 'Service', 11);
        /*33*/$this->createNew('Centre National De Magasinage', 'Service', 11);

        /*34*/$this->createNew('Service Animation Commerciale Et Merchandising', 'Service', 12);
        /*35*/$this->createNew('Service Ventes', 'Service', 12);
        /*36*/$this->createNew('Service Ventes Indirectes', 'Service', 12);
        /*37*/$this->createNew('Service Ventes Entreprises', 'Service', 12);
        /*38*/$this->createNew('Service Sav Et Approvisionnement', 'Service', 12);

        /*39*/$this->createNew('Service Communication Produits', 'Service', 13);
        /*40*/$this->createNew('Service Marketing', 'Service', 13);
        /*41*/$this->createNew('Service Veille Et Etudes', 'Service', 13);
        /*42*/$this->createNew('Service Offres Fixe Et Entreprises', 'Service', 13);

        /*43*/$this->createNew('Service Interconnexion Internationale Et Roaming', 'Service', 14);
        /*44*/$this->createNew('Service Interconnexion Nationale', 'Service', 14);

        /*45*/$this->createNew('Centre D’appels', 'Service', 15);
        /*46*/$this->createNew('Centre Traitement Des Reclamations', 'Service', 15);
        /*47*/$this->createNew('Service Facturation', 'Service', 15);
        /*48*/$this->createNew('Service Recouvrement', 'Service', 15);
        /*49*/$this->createNew('Service Relation Clients', 'Service', 15);

        /*50*/$this->createNew('Service Exploitation Et Maintenance Reseaux Fixes', 'Service', 16);
        /*51*/$this->createNew('Service Maintenance Environnement Technique', 'Service', 16);
        /*52*/$this->createNew('Service Installation Et SAV', 'Service', 16);
        /*53*/$this->createNew('Service Maintenance Radio', 'Service', 16);
        /*54*/$this->createNew('Service Maintenance Transmission Et IP', 'Service', 16);
        /*55*/$this->createNew('Service NOC', 'Service', 16);
        /*56*/$this->createNew('Service Maintenance Core Et RVA', 'Service', 16);
        /*57*/$this->createNew('Site Technique Redondance Nss Gros-Bouquet', 'Service', 16);
        /*58*/$this->createNew('Centre Approvisionnement', 'Service', 16);
        /*59*/$this->createNew('Centre Bureau D’etudes', 'Service', 16);
        /*60*/$this->createNew('Centre De Production', 'Service', 16);
        /*61*/$this->createNew('Centre D’exploitation MSAN', 'Service', 16);
        /*62*/$this->createNew('Centre Environnement CENACOM', 'Service', 16);
        /*63*/$this->createNew('Centre Fichier Technique D’abonnes', 'Service', 16);
        /*64*/$this->createNew('Centre International Du Cable Sous-Marin Sat 3', 'Service', 16);
        /*65*/$this->createNew('Centre National Des Transmissions Par Satellite De Nkoltang', 'Service', 16);
        /*66*/$this->createNew('Centre National De Production Et Internet', 'Service', 16);
        /*67*/$this->createNew('Centre National De Supervision', 'Service', 16);
        /*68*/$this->createNew('Centre National Des Transmissions Hertziennes Et Optiques De Nkologoum', 'Service', 16);
        /*69*/$this->createNew('Centre National Environnement Technique', 'Service', 16);
        /*70*/$this->createNew('Centre National Et International Fixe', 'Service', 16);
        /*71*/$this->createNew('Centre National Maintenance BSS Mobile', 'Service', 16);
        /*72*/$this->createNew('Centre NSS Mobile Et Transit', 'Service', 16);
        /*73*/$this->createNew('Centre Reseau Intelligent IN', 'Service', 16);
        /*74*/$this->createNew('Centre Technique Gros-Bouquet', 'Service', 16);
        /*75*/$this->createNew('Centre Technique Agondje', 'Service', 16);
        /*76*/$this->createNew('Centre Technique CENACOM', 'Service', 16);
        /*77*/$this->createNew('Centre Technique Mindoube', 'Service', 16);
        /*78*/$this->createNew('Centre Technique Nzeng-Ayong', 'Service', 16);
        /*79*/$this->createNew('Centre Technique De Lambarene', 'Service', 16);

        /*80*/$this->createNew('Service Deploiement Acces Et Transmission', 'Service', 17);
        /*81*/$this->createNew('Service Deploiement Du Reseau Core & PFS', 'Service', 17);
        /*82*/$this->createNew('Service Ingenierie Et Performances', 'Service', 17);
        /*83*/$this->createNew('Service Reseaux D’entreprises', 'Service', 17);

        /*84*/$this->createNew('Service Integration Et Support', 'Service', 18);
        /*85*/$this->createNew('Service SI Metier', 'Service', 18);
        /*86*/$this->createNew('Service SI Production', 'Service', 18);

        // Les Zones

        /*87*/$this->createNew('Zone Centre (Estuaire Et Moyen Ogooue)', 'Zone', null);
        /*88*/$this->createNew('Zone Cote-Ouest (Ogooue Maritime)', 'Zone', null);
        /*89*/$this->createNew('Zone Nord (Woleu-Ntem Et Ogooue Ivindo)', 'Zone', null);
        /*90*/$this->createNew('Zone Sud-Est (Haut Ogooue Et Ogooue Lolo)', 'Zone', null);
        /*91*/$this->createNew('Zone Sud-Ouest (Ngounie Et Nyanga)', 'Zone', null);

        // Les Agences

        /*92*/$this->createNew('Agence Commerciale Okala', 'Agence', 87);
        $this->createNew('Agence Commerciale Grands Comptes Et Entreprises', 'Agence', 87);
        $this->createNew('Agence Commerciale De Nzeng Ayong', 'Agence', 87);
        $this->createNew('Agence Commerciale D’owendo', 'Agence', 87);
        $this->createNew('Box Super Ckdo Owendo', 'Agence', 87);
        $this->createNew('Agence Principale', 'Agence', 87);
        $this->createNew('Agence Commerciale De Sainte Marie', 'Agence', 87);
        $this->createNew('Agence Commerciale De Sogalivre', 'Agence', 87);
        $this->createNew('Agence Commerciale Vente Indirecte', 'Agence', 87);
        $this->createNew('Agence Commerciale Mont-Bouet', 'Agence', 87);
        $this->createNew('Agence Commerciale PK 8', 'Agence', 87);
        $this->createNew('Agence Commerciale FTTH', 'Agence', 87);
        $this->createNew('Agence Commerciale IFG', 'Agence', 87);
        $this->createNew('Agence Commerciale Awendje', 'Agence', 87);
        $this->createNew('Agence Commerciale Renovation', 'Agence', 87);
        $this->createNew('Agence Commerciale De Lambarene', 'Agence', 87);
        $this->createNew('Centre De Saisie Et Archivage', 'Agence', 87);

        $this->createNew('Agence Commerciale De Port-Gentil', 'Agence', 88);
        $this->createNew('Agence Commerciale Gamba', 'Agence', 88);
        $this->createNew('Centre Technique De Port-Gentil', 'Agence', 88);
        $this->createNew('Centre Technique De Gamba', 'Agence', 88);

        $this->createNew('Agence Commerciale D’Oyem', 'Agence', 89);
        $this->createNew('Agence Commerciale De Bitam', 'Agence', 89);
        $this->createNew('Agence Commerciale De Makokou', 'Agence', 89);
        $this->createNew('Centre Technique D’Oyem', 'Agence', 89);
        $this->createNew('Centre Technique De Makokou', 'Agence', 89);
        $this->createNew('Site Technique Bitam', 'Agence', 89);
        $this->createNew('Centre Technique De Booue', 'Agence', 89);
        $this->createNew('Centre Technique De Ndjole', 'Agence', 89);
        $this->createNew('Agence Commerciale De Franceville', 'Agence', 90);
        $this->createNew('Agence Commerciale De Moanda', 'Agence', 90);
        $this->createNew('Agence Commerciale De Koulamoutou', 'Agence', 90);
        $this->createNew('Centre Technique De Franceville', 'Agence', 90);
        $this->createNew('Centre Technique De Moanda', 'Agence', 90);
        $this->createNew('Centre Technique De Koulamoutou', 'Agence', 90);
        $this->createNew('Site Technique De Lastourville', 'Agence', 90);
        $this->createNew('Agence Commerciale De Mouila', 'Agence', 91);
        $this->createNew('Agence Commerciale De Tchibanga', 'Agence', 91);
        $this->createNew('Centre Technique De Mouila', 'Agence', 91);
        $this->createNew('Centre Technique De Tchibanga', 'Agence', 91);
        $this->createNew('Centre Technique Mandji', 'Agence', 91);
    }

    private function createNew($intitule, $type_departement_tag, $parent_id) {
      $this->createNewRaw($intitule, $this->getCheminComplet($intitule, $parent_id), TypeDepartement::tagged($type_departement_tag)->first()->id, $parent_id);
    }

    private function createNewRaw($intitule, $chemin_complet, $type_departement, $parent_id) {
        Departement::create(['intitule' => $intitule, 'chemin_complet' => $chemin_complet, 'type_departement_id' => $type_departement, 'departement_parent_id' => $parent_id, 'statut_id' => Statut::default()->first()->id]);
    }
}
