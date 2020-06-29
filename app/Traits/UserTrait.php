<?php

namespace App\Traits;
use Hash;


trait UserTrait {

  use StatutTrait;

  public function formatRequestInput($request){
      $formInput = $request->all();
      $formInput = $this->setStatutFromRequestInput($formInput);

      // si le champs password n'est pas vide
      if(!empty($formInput['password'])){
          // on hash le mot de passe
          $formInput['password'] = Hash::make($formInput['password']);
      }else{
          // sinon, on le retire de la liste des champs
          unset($formInput['password']);
      }

      // is_local
      $formInput['is_local'] = array_key_exists('is_local', $formInput);
      // is_ldap
      $formInput['is_ldap'] = array_key_exists('is_ldap', $formInput);

      return $formInput;
  }
}
