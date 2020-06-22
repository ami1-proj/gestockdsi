<?php

namespace App\Traits;
use App\FonctionEmploye;
use App\Statut;

trait FonctionEmployeTrait {

    use StatutTrait;
    use ImageTrait;

    public function formatRequestInput($request){
        $formInput = $request->all();
        $formInput = $this->setStatutFromRequestInput($formInput);

        return $formInput;
    }
}
