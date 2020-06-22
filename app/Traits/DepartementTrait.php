<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Departement;

trait DepartementTrait {
  use StatutTrait;

	public function formatRequestInput(&$request){

      $formInput = $request->all();
      $formInput = $this->setStatutFromRequestInput($formInput);

      // Formattage des Tags a insérer dans la DB
      $formInput = $this->formatTags($formInput);

      return $formInput;
  }

  public function getCheminCompletFromRequest($request) {
    $formInput = $request->all();
    if (array_key_exists('intitule', $formInput) && array_key_exists('departement_parent_id', $formInput)) {
      return $this->getCheminComplet($formInput['intitule'], $formInput['departement_parent_id']);
    } else {
      return null;
    }
  }

  public function getCheminComplet($intitule, $parent_id) {
    return Departement::getCheminComplet($intitule, $parent_id);
  }
}
