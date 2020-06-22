<?php
namespace App\Traits;
use App\Phonenum;
use App\Adresseemail;


trait FournisseurTrait {
	use StatutTrait;
	use AdresseemailTrait;
	use PhonenumTrait;

	public function formatRequestInput($request, &$email, &$phone){

        // Formattage des Tags a insérer dans la DB
        //$formInput = $this->setFormatTags($formInput);
				$formInput = $request->all();
				$formInput = $this->setStatutFromRequestInput($formInput);
				$formInput['raison_sociale'] = strtoupper($formInput['nom']) . ' ' . ucwords($formInput['prenom']);

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

        return $formInput;
  }

	public function afterDelete($fournisseur) {
			$phonenums = $fournisseur->phonenums;
			$adresseemails = $fournisseur->adresseemails;

			//$fournisseur->phonenums()->detach();
			//$fournisseur->adresseemails()->detach();

			foreach ($phonenums as $phonenum) {
				$phone = Phonenum::find($phonenum->id);
				$phone->delete();
			}
			foreach ($adresseemails as $adresseemail) {
				$email = Adresseemail::find($adresseemail->id);
				$email->delete();
			}
	}
}
