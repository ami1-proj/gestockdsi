<?php

namespace App\Traits;

trait StockTrait {

  use StatutTrait;

  public function formatRequestInput($request){
      $formInput = $request->all();
      $formInput = $this->setStatutFromRequestInput($formInput);

      return $formInput;
  }
}
