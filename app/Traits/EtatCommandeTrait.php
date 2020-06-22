<?php

namespace App\Traits;
use App\EtatCommande;

trait EtatCommandeTrait {

    use StatutTrait;

    public function formatRequestInput($request){
        $formInput = $request->all();

        $formInput = $this->setStatutFromRequestInput($formInput);
        $formInput = $this->setDefaultFromRequestInput($formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    // public function unsetDefaultEtatCommande($curr_etatcommande) {
    //   $this->unsetDefault($curr_etatcommande, EtatCommande::default([$curr_etatcommande->id])->first());
    // }
}
