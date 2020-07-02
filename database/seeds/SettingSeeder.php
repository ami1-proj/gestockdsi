<?php

    use App\Setting;
    use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'group' => "article",'name' => "nb_jrs_article_neuf", 'value' => "10", 'type' => "integer", 'description' => "nombre de jours jours max durant lesquels un article en affectation est considéré neuf."
            ],
            [
                'group' => "ldap",'name' => "liste_sigles", 'value' => "gt,rh,si,it,sav,in,bss,msan,rva,erp,dr", 'type' => "array", 'description' => "liste des sigles (à prendre en compte dans l importation LDAP)."
            ]
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
