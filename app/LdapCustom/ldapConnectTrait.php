<?php

namespace App\LdapCustom;

use Adldap\Laravel\Facades\Adldap;
use App\Adresseemail;
use App\Departement;
use App\Employe;
use App\FonctionEmploye;
use App\Ldapimport;
use App\Phonenum;
use App\Statut;
use App\TypeDepartement;
use App\Traits\AdresseemailTrait;
use App\Traits\PhonenumTrait;

/**
 * Trait LdapConnectTrait
 * @package App\LdapCustom
 */
trait LdapConnectTrait {

    use AdresseemailTrait;
    use PhonenumTrait;

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
      $this->adldapSyncUser("Jude Parfait NGOM NZE");
      $this->adldapSyncUser("Isabelle BULABULA Èp. NDAYWEL");
      $this->adldapSyncUser("Bernice MINDILA MANDOUKOU");
      $this->adldapSyncUser("Camille LEYOUNGASSA");
      $this->adldapSyncUser("Agnes Grezillia ENAME OBIANG");
  }

    /**
     * @param String $username nom complet de l'utilisateur
     */
  public function adldapSyncUser(String $username) {
      $user = Adldap::search()->users()->find($username);
      if ($user) {
          $userimported = Ldapimport::where('email', $user->getFirstAttribute('userprincipalname'))->first();
          if ($userimported) {
              $newvalues = [];
              foreach ($userimported->getLdapColumns() as $column) {
                  $ldap_val = $user->getFirstAttribute($column);
                  if ($ldap_val) {
                      dump('col: ',$column);
                      //$userimported->{"ldap_" . $column} = $ldap_val;
                      if ($column === "thumbnailphoto") {
                          $ldap_val = decbin(ord($ldap_val));
                      }
                      $newvalues["ldap_" . $column] = $ldap_val;
                      //$userimported->{$column . "_result"} = "OK.";
                      $newvalues[$column . "_result"] = "OK.";
                  } else {
                      //$userimported->{$column . "_result"} = "champs non existant pour cet utilisateur.";
                      $newvalues[$column . "_result"] = "champs non existant pour cet utilisateur.";
                  }
              }
              dump('user: ',$user);
              dump('userimported bfor save: ', $userimported);
              dump('newvalues: ', $newvalues);
              //$userimported->save();
              $userimported->update($newvalues);
              dump('userimported after save: ', $userimported);
              $this->setEmployeInfos($username, $userimported, $user);
          }
      }
  }

  private function setEmployeInfos(String $username, Ldapimport $userimported, $userldap) {
      $employe = Employe::where('objectguid', $userimported->objectguid)->first();
      if (! $employe) {
          $employe = Employe::create([
              'objectguid' => $userimported->objectguid,
              'statut_id' => Statut::actif()->first()->id,
          ]);
      }

      if ($employe) {
          foreach ($userimported->getLdapColumns() as $column) {
              $ldap_val = $userldap->getFirstAttribute($column);
              if ($ldap_val) {
                  if ($column === "sn") {
                      // Nom de famille
                      $employe->nom = ucwords($ldap_val);
                  } elseif ($column === "givenname") {
                      // Prénom
                      $employe->prenom = ucwords($ldap_val);
                  } elseif ($column === "title") {
                      // fonction employe
                      $fonctionemploye = FonctionEmploye::where('intitule', 'LIKE', '%' . $ldap_val . '%')->first();
                      if (!$fonctionemploye) {
                          $fonctionemploye = FonctionEmploye::create([
                              'intitule' => $ldap_val,
                              'description' => $ldap_val,
                              'statut_id' => Statut::actif()->first()->id,
                          ]);
                      }
                      $employe->fonction_employe_id = $fonctionemploye->id;
                  } elseif ($column === "distinguishedname") {
                      // infos complets de l employé
                      $dpt_tree = str_replace("CN=" . $username, "", $ldap_val);
                      $dpt_tree = str_replace(["OU=UTILISATEURS","DC=groupegt","DC=ga","OU="], "", $dpt_tree);
                      $dpt = $this->parseDepartementTree($dpt_tree);
                      $employe->departement_id = $dpt->id;
                  } elseif ($column === "mail") {
                      // adresse email
                      $email = Adresseemail::where('email', $ldap_val)->first();
                      if (!$email) {
                          $email = $this->createNewAdresseemail($ldap_val, 'employe', $employe->id);
                      }
                  } elseif ($column === "telephonenumber") {
                      // phone num
                      $phonenum = Phonenum::where('numero', $ldap_val)->first();
                      if (!$phonenum) {
                          $phonenum = $this->createNewPhonenum($ldap_val, 'employe', $employe->id);
                      }
                  } elseif ($column === "thumbnailphoto") {
                      // photo de profil
                      if ($column === "thumbnailphoto") {
                          $employe->thumbnailphoto = decbin(ord($ldap_val));
                      }
                      //$employe->thumbnailphoto = $ldap_val;
                  }
              }
          }

          $employe->save();
      }
  }

    /**
     * @param $tree chemin du département (chaque branche séparée par virgule)
     * @return |null
     */
  private function parseDepartementTree($tree) {
        $tree_tab = explode(',', $tree);
        $prev_dept = null;
        $first_dept = null;
        foreach ($tree_tab as $dept) {
            $dept = ucwords($dept);
            $curr_dept = Departement::where('intitule', $dept)->first();
            if (! $curr_dept) {
                // création d'un nouveau département
                $curr_dept = Departement::create([
                    'intitule' => $dept,
                    'description' => $dept,
                    'statut_id' => Statut::actif()->first()->id,
                ]);
                // Recherche du type de dépertement en fonction de l'intitulé
                $type_dpt_id = $this->parseDepartementType($dept);
                if ($type_dpt_id) {
                    $curr_dept->type_departement_id = $type_dpt_id;
                }
            }
            // Set du parent du précédent
            if ($prev_dept){
                $prev_dept->departement_parent_id = $curr_dept->id;
                $prev_dept->save();
            } else {
                $first_dept = $curr_dept;
            }
            $curr_dept->save();
            // On assigne le précédent
            $prev_dept = $curr_dept;
        }
        return $first_dept;
  }

    /**
     * @param $intitule intitulé du département
     * @return int|null
     */
  private function parseDepartementType($intitule) {
      if (strpos(strtolower($intitule), 'service') !== false) {
          $type = TypeDepartement::where('intitule', 'Service')->first();
          return $type->id;
      } elseif (strpos(strtolower($intitule), 'direction') !== false) {
          $type = TypeDepartement::where('intitule', 'Direction')->first();
          return $type->id;
      } elseif (strpos(strtolower($intitule), 'division') !== false) {
          $type = TypeDepartement::where('intitule', 'Division')->first();
          return $type->id;
      } elseif (strpos(strtolower($intitule), 'zone') !== false) {
          $type = TypeDepartement::where('intitule', 'Zone')->first();
          return $type->id;
      } elseif (strpos(strtolower($intitule), 'agence') !== false) {
          $type = TypeDepartement::where('intitule', 'Agence')->first();
          return $type->id;
      } else {
          return null;
      }
  }
}
