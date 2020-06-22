<?php

use Illuminate\Database\Seeder;
use App\Statut;


class InsertFakePhonesAndEmails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertion de 150 + 40 (faux) numeros de telephone
        factory(App\Phonenum::class, 190)->create();

        // Insertion de 100 + 40 e-mail adresses
        factory(App\Adresseemail::class, 140)->create();

        // affectation de 2 numeros de telephones par fournisseurs
        $this->AffecterElemPhonenumOrAdresseemail(2,'fournisseurs','phonenums', 'fournisseur_phonenum');

        // affectation de 1 e-mail adresses par fournisseur
        $this->AffecterElemPhonenumOrAdresseemail(2,'fournisseurs','adresseemails', 'adresseemail_fournisseur');

        // affectation de 1 numero de telephone par employé
        $this->AffecterElemPhonenumOrAdresseemail(3,'employes','phonenums', 'employe_phonenum');

        // affectation de 1 e-mail adresses par employe
        $this->AffecterElemPhonenumOrAdresseemail(2,'employes','adresseemails', 'adresseemail_employe');
    }

    private function GetAffectablePhonenumOrAdresseemail($elem, $phonenumOrAdresseemail, $pivot) {
      $elem_id_field = substr($elem, 0, -1) . '_id';
      $affected_phonenumsOrAdresseemails = DB::table($pivot)->get()->pluck($elem_id_field)->toArray();

      $affectable_id = DB::table($phonenumOrAdresseemail)->whereNotIn('id', $affected_phonenumsOrAdresseemails)->min('id');

      //dd($pivot, $elem, $elem_id_field, $phonenumOrAdresseemail, $affectable_id);

      return $affectable_id;
    }

    private function AffecterElemPhonenumOrAdresseemail($nbaffectations, $elem, $phonenumOrAdresseemail, $pivot) {
      $elem_id_min = DB::table($elem)->min('id');
      $elem_id_max = DB::table($elem)->max('id');

      $phonenumOrAdresseemail_id = DB::table($phonenumOrAdresseemail)->min('id');

      for ($elem_id=$elem_id_min; $elem_id <= $elem_id_max; $elem_id++) {
          $rang = 1;
          $a = 1;
          while ($a <= $nbaffectations) {

            $this->InsertElemPhonenumOrAdresseemail($elem, $phonenumOrAdresseemail, [$elem_id, $phonenumOrAdresseemail_id]);

            $a += 1;
            $phonenumOrAdresseemail_id += 1;
          }
      }
    }

    private function InsertElemPhonenumOrAdresseemail($elem, $phonenumOrAdresseemail, $values) {
      $defaultstatut = Statut::default()->first();
      if ($elem == 'fournisseurs') {
          if ($phonenumOrAdresseemail == 'phonenums') {
              $rang = DB::table('fournisseur_phonenum')->where('fournisseur_id', $values[0])->count();
              $rang += 1;
              DB::table('fournisseur_phonenum')->insert([
                'rang' => $rang,
                'fournisseur_id' => $values[0],
                'phonenum_id' => $values[1],
                'statut_id' => $defaultstatut->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ]);
          } else {
              $rang = DB::table('adresseemail_fournisseur')->where('fournisseur_id', $values[0])->count();
              $rang += 1;
              DB::table('adresseemail_fournisseur')->insert([
                'rang' => $rang,
                'fournisseur_id' => $values[0],
                'adresseemail_id' => $values[1],
                'statut_id' => $defaultstatut->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ]);
          }
      } else {
          if ($phonenumOrAdresseemail == 'phonenums') {
              $rang = DB::table('employe_phonenum')->where('employe_id', $values[0])->count();
              $rang += 1;
              DB::table('employe_phonenum')->insert([
                'rang' => $rang,
                'employe_id' => $values[0],
                'phonenum_id' => $values[1],
                'statut_id' => $defaultstatut->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ]);
          } else {
              $rang = DB::table('adresseemail_employe')->where('employe_id', $values[0])->count();
              $rang += 1;
              DB::table('adresseemail_employe')->insert([
                'rang' => $rang,
                'employe_id' => $values[0],
                'adresseemail_id' => $values[1],
                'statut_id' => $defaultstatut->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ]);
          }
      }
    }
}
