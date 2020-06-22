<?php

namespace App\Traits;
use App\TypeDepartement;

trait TypeDepartementTrait {

    use StatutTrait;

    public function formatRequestInput($request){
        $formInput = $request->all();

        $formInput = $this->setStatutFromRequestInput($formInput);
        $formInput = $this->setDefaultFromRequestInput($formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    // public function unsetDefaultTypeDepartement($curr_typedepartement) {
    //   $this->unsetDefault($curr_typedepartement, TypeDepartement::default([$curr_typedepartement->id])->first());
    // }
}
