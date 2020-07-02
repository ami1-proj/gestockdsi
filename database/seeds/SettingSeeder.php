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
            ],
            [
                'group' => "affectation",'name' => "notifier_beneficiaire", 'value' => "1", 'type' => "bool", 'description' => "indique si le bénéficiaire doit etre notifié après affectation"
            ],
            [
                'group' => "affectation",'name' => "notifier_adminfonc", 'value' => "1", 'type' => "bool", 'description' => "indique si les admin fonctionnels doivent etre notifiés après affectation"
            ],
            [
                'group' => "affectation",'name' => "adminfonc_a_notifier", 'value' => "M.NKOROUNA@gabontelecom.ga,S.MBEMBO@gabontelecom.ga,J.NGOMNZE@gabontelecom.ga", 'type' => "array", 'description' => "liste des emails des admin fonctionnels à notifier après affectation"
            ]
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
