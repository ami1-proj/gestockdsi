<?php

namespace App\Traits;
use Illuminate\Http\Request;
use App\Service;

trait ServiceTrait {


	use TagTrait;

	public function formatRequestInput($formInput){

        // Formattage des Tags a insérer dans la DB
        $formInput = $this->setFormatTags($formInput);

        return $formInput;
    }
}
    

