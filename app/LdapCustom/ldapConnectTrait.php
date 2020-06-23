<?php

namespace App\LdapCustom;

trait LdapConnectTrait {

  public function ldapconnect()
  {
      $ad_host = config('app.ldap_host');
      $ad_domain = config('app.ldap_domain');
      $ad_dn = config('app.ldap_base_dn');

      $ad_conn = ldap_connect($ad_host, 389);

      if ($ad_conn) 
      {
          if (ldap_set_option($ad_conn, LDAP_OPT_PROTOCOL_VERSION, 3)) 
          {
            if (ldap_set_option($ad_conn, LDAP_OPT_REFERRALS, 0)) 
            {
              return [$ad_conn,"connection LDAP réussie"];
            }
            else 
            {
              return [$ad_conn,"Protocole Ldap V2 inapplicable!"];
            }
          } 
          else 
          {
             return [$ad_conn,"La connection a echouee AD!"];
          }
      } 
      else 
      {
        return [$ad_conn,"Protocole Ldap V1 inapplicable!"];
      }
  }

  public function ldapauthenticate($username, $password )
  {
      $ad_domain = config('app.ldap_domain');
      $user = $username. '' .$ad_domain;
      
      $ad_conn = $this->ldapconnect();

      if ($ad_conn[0]) {
        $auth_ad_with_user = @ldap_bind($ad_conn, $user, $pass);
        if ($auth_ad_with_user)  
        {
          return [$auth_ad_with_user,"succes authentification !"];
        } else {
          return [$auth_ad_with_user,"echec authentification !"];
        }
      } else {
          return $ad_conn;
      }

    }

    public function ldapGetUsersold()
    {
        $ad_conn = $this->ldapconnect();
        $person = "";
        $dn = "o=My Company, c=US";
        $filter="(|(sn=$person*)(givenname=$person*))";
        $justthese = array("ou", "sn", "givenname", "mail");
        
        if ($ad_conn[0]) {
          $sr=ldap_search($ad_conn[0],$ad_conn, $filter, $justthese);
          $info = ldap_get_entries($ds, $sr);
        }

        dd($ad_conn,$sr,$info);
    }

    public function ldapGetUsers()
    {
      $ad_domain = config('app.ldap_domain');
      $ldapuser = 'jngom' . '' .$ad_domain;
      $ldappass = 'P@rfait1283';
      $ldaptree = config('app.ldap_tree');
      
      //$ad_conn = $this->ldapconnect();
      $ad_host = config('app.ldap_host');
      //$ldapconn = ldap_connect($ad_host);
        
     // tentative de bind au serveur ldap
     $ldapbind = $this->ldapauthenticate($ldapuser, $ldappass);
     dd($ldapbind);
     if ($ldapbind) {
          if ($ldapbind) {
            $result = ldap_search($ldapconn,$ldaptree, "(cn=*)"); 
            if ( $result ){
              $data = ldap_get_entries($ldapconn, $result);
              dd($data);
            } else { 
              // échec résultat
              return [$ldapbind,"erreur !"];
            }
          } else {
            // échec bind
            return [$ldapbind,"echec bind !"]; 
          } 

     } else {
        return $ad_conn;
     }




    }
}
