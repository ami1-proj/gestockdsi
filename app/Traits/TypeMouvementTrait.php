<?php

namespace App\Traits;
use App\TypeMouvement;

trait TypeMouvementTrait {

    use StatutTrait;

    public function formatRequestInput($request){
        $formInput = $request->all();

        $formInput = $this->setStatutFromRequestInput($formInput);
        $formInput = $this->setDefaultFromRequestInput($formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    // public function unsetDefaultTypeMouvement($curr_typemouvement) {
    //   $this->unsetDefault($curr_typemouvement, TypeMouvement::default([$curr_typemouvement->id])->first());
    // }
}
