<?php

namespace App\Traits;
use App\EtatArticle;

trait EtatArticleTrait {

    use StatutTrait;


    public function formatRequestInput($request){
        $formInput = $request->all();

        $formInput = $this->setStatutFromRequestInput($formInput);
        $formInput = $this->setDefaultFromRequestInput($formInput);
        $formInput = $this->formatTags($formInput);

        return $formInput;
    }

    // public function unsetDefaultEtatArticle($curr_etatarticle) {
    //   $this->unsetDefault($curr_etatarticle, EtatArticle::default([$curr_etatarticle->id])->first());
    // }
}
