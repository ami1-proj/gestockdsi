<?php

namespace App\LdapCustom;

use Adldap\Connections\Ldap;
use Adldap\Laravel\Facades\Adldap;

/**
 * Trait LdapConnectTrait
 * @package App\LdapCustom
 */
trait LdapConnectTrait {

    public function ldapGetUsers()
    {
        $ldapuser = config('app.ldap_base_user');
        $ldappass = config('app.ldap_base_userpwd');
        $ldaptree = config('app.ldap_tree');

        $ldapbind = $this->ldapauthenticate($ldapuser, $ldappass);

        if ($ldapbind[1]) {
            $result = ldap_search($ldapbind[0],$ldaptree, "(cn=*)");
            if ( $result ){
                $data = ldap_get_entries($ldapbind[0], $result);
                dd($data);
            } else {
              // échec résultat
              return [$ldapbind,"erreur !"];
            }
        } else {
            // échec bind
            return [$ldapbind,"echec bind !"];
        }
    }

    /**
     * @param $username
     * @param $password
     * @return array
     */
    public function ldapauthenticate($username, $password )
  {
      $ad_domain = config('app.ldap_domain');
      $user = $username. '' .$ad_domain;

      $ad_conn = $this->ldapconnect();

      if ($ad_conn[0]) {
        $auth_ad_with_user = @ldap_bind($ad_conn[0], $user, $password);
        if ($auth_ad_with_user)
        {
          return [$ad_conn[0],$auth_ad_with_user,"succes authentification !"];
        } else {
          return [$ad_conn,$auth_ad_with_user,"echec authentification !"];
        }
      } else {
          return $ad_conn;
      }

    }

  public function ldapconnect()
  {
      $ad_host = config('app.ldap_host');
      $ad_domain = config('app.ldap_domain');
      $ad_dn = config('app.ldap_base_dn');
      $ad_port = config('app.ldap_port');

      $ad_conn = ldap_connect($ad_host, $ad_port);

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

  public function adldapGetUsers() {
      // Finding a user:
      //$user = Adldap::search()->users()->find('jude');
      //dd($user);
      /*$this->adldapSyncUser("Jude Parfait NGOM NZE");
      $this->adldapSyncUser("Isabelle BULABULA Èp. NDAYWEL");
      $this->adldapSyncUser("Bernice MINDILA MANDOUKOU");
      $this->adldapSyncUser("Camille LEYOUNGASSA");
      $this->adldapSyncUser("Agnes Grezillia ENAME OBIANG");*/
      //$this->adldapSyncUsers();
  }
}
