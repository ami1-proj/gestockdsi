<?php

use Illuminate\Database\Seeder;

class TestModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InsertFakeEmployes::class);
        $this->call(InsertFakeFournisseurs::class);
        $this->call(InsertFakeArticles::class);
        $this->call(InsertFakePhonesAndEmails::class);
    }
}
