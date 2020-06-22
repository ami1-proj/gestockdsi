<?php

namespace App\Traits;
use Hash;


trait UserTrait {

  use StatutTrait;

  public function formatRequestInput($request){
      $formInput = $request->all();
      $formInput = $this->setStatutFromRequestInput($formInput);

      if(!empty($formInput['password'])){
          $formInput['password'] = Hash::make($formInput['password']);
      }else{
          //$formInput = array_except($formInput,array('password'));
          unset($formInput['password']);
      }

      return $formInput;
  }
}
