<?php

use Illuminate\Database\Seeder;
use App\TypeArticle;
use App\Statut;

class TypeArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Unite Centrale','Ensemble constitutif d un ordinateur et de son châssis.','unite_centrale.jpg');
        $this->createNew('Souris','Dispositif de pointage qui se relie à l ordinateur','souris.jpg');
        $this->createNew('Clavier','périphérique permettant d écrire du texte et communiquer avec l ordinateur','clavier.jpg');
        $this->createNew('Imprimante','Périphérique d ordinateur qui imprime sur papier des textes ou des éléments graphiques.','imprimante_bureau.jpg');
        $this->createNew('Onduleur','dispositif d électronique de puissance permettant de générer des tensions et des courants alternatifs à partir dune source d énergie électrique de tension ou de fréquence différente.','onduleur.jpg');
        $this->createNew('Telephone fix','systèmes téléphoniques dont la ligne terminale d abonné est située à un emplacement fixe','telephone_fix.jpg');
        $this->createNew('Switch','équipement ou appareil qui permet linterconnexion dappareils communicants, terminaux, ordinateurs, serveurs, périphériques reliés à un même réseau physique.','switch.jpg');
        $this->createNew('Ecrant TV','appareil affichant sur un écran des émissions de télévision.','ecrant_tv.jpg');
        $this->createNew('Antivirus','Logiciel capable de détecter les virus informatiques et de les éliminer','antivirus.jpg');
        $this->createNew('Barette memoire',' mémoire informatique dans laquelle un ordinateur place les données lors de leur traitement','barette_memoire.jpg');
        $this->createNew('Code barre','représentation d’une donnée numérique ou alphanumérique sous forme dun symbole constitué de barres et d’espaces dont l épaisseur varie en fonction de la symbologie utilisée et des données ainsi codées.','barette_memoire.jpg');
        $this->createNew('Routeur','équipement réseau informatique assurant le routage des paquets. Son rôle est de faire transiter des paquets dune interface réseau vers une autre, au mieux, selon un ensemble de règles.','routeur.jpg');
        $this->createNew('Bande de sauvegarde','automatiser la manipulation de bandes magnétiques lors des sauvegarde ou restauration de données.','bandesauv.jpg');
        $this->createNew('Camera ip','caméra de surveillance utilisant le Protocole Internet pour transmettre des images et des signaux de commande via une liaison Fast Ethernet. Certaines caméras IP sont reliées à un enregistreur vidéo numérique (DVR) ou un enregistreur vidéo en réseau (NVR) pour former un système de surveillance vidéo.','cam.jpg');
        $this->createNew('Module fribre optique','un module émetteur-récepteur optique compact et enfichable à chaud qui est largement utilisé pour toutes les applications de télécommunications et de transmission de données.','module.jpg');
        $this->createNew('Batterie laptop',' batterie rechargeable, intégrée à l’ordinateur portable.','batterie.jpg');
        $this->createNew('USB RS233','  ','rs233.jpg');
        $this->createNew('Multiprise','Prise de courant électrique permettant de relier plusieurs appareils.','multi.jpg');
        $this->createNew('Scanner','permet de transférer des documents sur papier vers des fichiers numériques.','scaner.jpg');
    }

    private function createNew($libelle,$description,$image) {
        TypeArticle::create(['libelle' => $libelle, 'description' => $description, 'image' => $image, 'is_default' => 0,'statut_id' => Statut::default()->first()->id]);
    }
}
