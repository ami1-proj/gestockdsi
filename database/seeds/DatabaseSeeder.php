<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppPermissionSeeder::class);

        $this->call(TagSeeder::class);
        $this->call(StatutSeeder::class);
        $this->call(TypeAffectationSeeder::class);
        $this->call(EtatArticleSeeder::class);
        $this->call(EtatCommandeSeeder::class);
        $this->call(TypeArticleSeeder::class);
        $this->call(MarqueArticleSeeder::class);
        $this->call(FonctionEmployeSeeder::class);

        $this->call(StockLieuSeeder::class);
        $this->call(StockSeeder::class);

        $this->call(StockEmplacementSeeder::class);
        $this->call(TypeMouvementSeeder::class);
        $this->call(AffectationSeeder::class);

        $this->call(TypeDepartementSeeder::class);
        $this->call(DepartementSeeder::class);
    }
}
