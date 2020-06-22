<?php

namespace App\Traits;
use App\TypeAffectation;

trait TypeAffectationTrait {

    use StatutTrait;


    public function formatRequestInput($request){
        $formInput = $request->all();

        $formInput = $this->setStatutFromRequestInput($formInput);
        $formInput = $this->setDefaultFromRequestInput($formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    // public function unsetDefaultTypeAffectation($curr_typeaffectation) {
    //   $this->unsetDefault($curr_typeaffectation, TypeAffectation::default([$curr_typeaffectation->id])->first());
    // }
}
