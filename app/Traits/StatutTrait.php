<?php

namespace App\Traits;
use App\Statut;

trait StatutTrait {

    use TagTrait;
    use DefaultTrait;


    public function formatRequestInput($formInput){

        $formInput = $this->setDefaultFromRequestInput($formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    // public function unsetDefaultStatut($curr_statut) {
    //   $this->unsetDefault($curr_statut, Statut::default([$curr_statut->id])->first());
    // }

    /**
     * Assigne le statut en fonction de la Requete
     * @param Request $formInput input de la requete
     */
    public function setStatutFromRequestInput($formInput) {
      if (array_key_exists('statut_id', $formInput)) {
        $formInput['statut_id'] = Statut::actif()->first()->id;
      } else {
        $formInput['statut_id'] = Statut::inactif()->first()->id;
      }

      return $formInput;
    }
}
