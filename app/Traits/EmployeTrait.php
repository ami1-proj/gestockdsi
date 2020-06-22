<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Employe;

trait EmployeTrait {
    use StatutTrait;
    use AdresseemailTrait;
    use PhonenumTrait;

    public function getEmployeFromRequest(Request $request) : Employe {
        $formInput = $request->all();
        $employe = New Employe();

        if (array_key_exists('id', $formInput)) { $employe->id = $formInput['id']; }

        if (array_key_exists('nom', $formInput)) { $employe->nom = $formInput['nom']; }
        if (array_key_exists('matricule', $formInput)) { $employe->matricule = $formInput['matricule']; }
        if (array_key_exists('prenom', $formInput)) { $employe->prenom = $formInput['prenom']; }
        if (array_key_exists('adresse', $formInput)) { $employe->adresse = $formInput['adresse']; }
        if (array_key_exists('fonction_employe_id', $formInput)) { $employe->fonction_employe_id = $formInput['fonction_employe_id']; }
        if (array_key_exists('statut_id', $formInput)) { $employe->statut_id = $formInput['statut_id']; }

        return $employe;
    }

    public function formatRequestInput($request, &$email, &$phone){
        $formInput = $request->all();
        $formInput = $this->setStatutFromRequestInput($formInput);
        // Retrait de l' e-mail et du téléphone du tableau INPUT
        if (array_key_exists('nouveau_email', $formInput)) {
          $email = $formInput['nouveau_email'];
          unset($formInput['nouveau_email']);
        }
        if (array_key_exists('nouveau_phone', $formInput)) {
          $phone = $formInput['nouveau_phone'];
          unset($formInput['nouveau_phone']);
        }

        // Modification des casses: Le Nom tout en majuscule, Les premières lettres du prénom en majuscule
        $formInput['nom'] = strtoupper($formInput['nom']);
        $formInput['prenom'] = ucwords($formInput['prenom']);

        $formInput = $this->formatTags($formInput);

        // if ( $formInput['tags'] == '' ) {
        //   unset($formInput['tags']);
        // }

        return $formInput;
    }
}
