<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createNew('Index');
        $this->createNew('Creation');
        $this->createNew('Modification');
        $this->createNew('Suppression');
        $this->createNew('Supprime');

        $this->createNew('Systeme');
        $this->createNew('Adressemail');
        $this->createNew('Affectation');
        $this->createNew('Article');
        $this->createNew('Commande');
        $this->createNew('Direction');
        $this->createNew('Division');
        $this->createNew('Service');
        $this->createNew('Zone');
        $this->createNew('Agence');
        $this->createNew('Departement');
        $this->createNew('Employe');
        $this->createNew('EtatArticle');
        $this->createNew('EtatCommande');
        $this->createNew('FonctionEmploye');
        $this->createNew('Fournisseur');
        $this->createNew('MarqueArticle');
        $this->createNew('Phonenum');
        $this->createNew('Stock');
        $this->createNew('StockEmplacement');
        $this->createNew('StockLieu');
        $this->createNew('TypeAffectation');
        $this->createNew('TypeArticle');
        $this->createNew('TypeMouvement');
        $this->createNew('User');
        $this->createNew('Role');
        $this->createNew('Permission');
    }

    private function createNew($name) {
        Tag::create(['name' => $name]);
    }
}
