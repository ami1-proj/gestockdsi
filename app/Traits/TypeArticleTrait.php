<?php

namespace App\Traits;
use App\TypeArticle;
use App\Statut;

trait TypeArticleTrait {

    use StatutTrait;
    use ImageTrait;

    public function formatRequestInput($request){
        $formInput = $request->all();

        $formInput = $this->setStatutFromRequestInput($formInput);
        if (array_key_exists('image', $formInput)) {
          $formInput['image'] = $this->verifyAndStoreImage($request, 'image', 'typearticle');
        }

        return $formInput;
    }
}
