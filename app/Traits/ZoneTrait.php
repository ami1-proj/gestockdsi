<?php
namespace App\Traits;


trait ZoneTrait {
	use TagTrait;

	public function formatRequestInput($formInput){

        // Formattage des Tags a insérer dans la DB
        $formInput = $this->setFormatTags($formInput);

        return $formInput;
    }
}