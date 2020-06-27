<?php

namespace App\LdapCustom;


use Adldap\Laravel\Facades\Adldap;
use App\Adresseemail;
use App\Departement;
use App\Employe;
use App\FonctionEmploye;
use App\LdapAccount;
use App\LdapAccountImport;
use App\Phonenum;
use App\Statut;
use App\TypeDepartement;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use App\Traits\AdresseemailTrait;
use App\Traits\PhonenumTrait;
use Illuminate\Support\Str;

trait LdapImportTrait {

    use AdresseemailTrait, PhonenumTrait;

    /**
     * Importe les comptes LDAP
     */
    public function importLdapAccounts() {
        // Tronquage de la table d'importation
        //DB::table('ldapaccountimports')->truncate();

        // Exécution de la commande d'importation
        //Artisan::call('adldap:import', ['--model' => "\App\LdapAccountImport", '--no-interaction']);

        // Traitement des lignes importées
        $accountsimported = LdapAccountImport::get();
        foreach ($accountsimported as $accountimported) {
            $this->adldapSyncUser($accountimported->name, $accountimported->objectguid);
        }
    }

    /**
     * Synchronise un compte LDAP
     * @param String $username
     * @param string $objectguid
     */
    public function adldapSyncUser(String $username, $objectguid = "") {
        $userldap = Adldap::search()->users()->find($username);
        if ($userldap) {
            //dump('1: $userldap', $userldap);
            $ldapaccount = LdapAccount::where('samaccountname', $userldap->getFirstAttribute('samaccountname'))->first();
            if (! $ldapaccount) {
                $ldapaccount = new LdapAccount();
                if ($objectguid !== "") {
                    $ldapaccount->objectguid = $objectguid;
                }
            }
            //dump('2: $ldapaccount', $ldapaccount);
            $newvalues = [];
            foreach ($ldapaccount->getLdapColumns() as $column) {
                $ldap_val = $userldap->getFirstAttribute($column);
                if ($ldap_val) {
                    if ($column === "thumbnailphoto") {
                        $ldap_val = decbin(ord($ldap_val));
                    }
                    $newvalues[$column] = $ldap_val;
                    $ldapaccount->{$column} = $ldap_val;
                    $newvalues[$column . "_result"] = "OK.";
                } else {
                    $newvalues[$column . "_result"] = "champs non existant pour cet utilisateur.";
                }
                $ldapaccount->{$column . "_result"} = $newvalues[$column . "_result"];
            }
            //dump('user: ',$user);
            //dump('userimported: ', $userimported);
            //dump('newvalues: ', $newvalues);
            $ldapaccount->save();
            //dump('3: $ldapaccount->save()', $ldapaccount);
            //$ldapaccount->update($newvalues);
            $this->setEmployeInfos($ldapaccount, $userldap);
            $this->createUser($ldapaccount);
        }
    }

    /**
     * Synchronise un compte LDAP avec un Employe du Système
     *
     * @param \App\LdapAccount $ldapaccount
     * @param $userldap
     */
    private function setEmployeInfos(LdapAccount $ldapaccount, $userldap) {
        $employe = Employe::where('objectguid', $ldapaccount->objectguid)->first();
        if (! $employe) {
            $employe = Employe::create([
                'objectguid' => $ldapaccount->objectguid,
                'statut_id' => Statut::actif()->first()->id,
            ]);
        }

        if ($employe) {
            foreach ($ldapaccount->getLdapColumns() as $column) {
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
                        $fonctionemploye = FonctionEmploye::where('slug', Str::slug($ldap_val))->first();
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
                        $dpt_tree = str_replace("CN=" . $userldap->getFirstAttribute("cn"), "", $ldap_val);
                        $dpt_tree = str_replace(["OU=UTILISATEURS","DC=groupegt","DC=ga","OU="], "", $dpt_tree);
                        $dpt = $this->parseDepartementTree($dpt_tree);
                        if ($dpt) {
                            $employe->departement_id = $dpt->id;
                        }
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
     * Parse le chemin d'un département
     * @param string $tree chemin du département (chaque branche séparée par une virgule)
     * @return \App\Departement|null
     */
    private function parseDepartementTree(string $tree) {
        $tree_tab = explode(',', $tree);
        $prev_dept = null;
        $first_dept = null;
        foreach ($tree_tab as $dept) {
            if (! empty($dept)) {
                $dept = $this->formatDepartementIntitule($dept);
                $curr_dept = Departement::where('intitule', $dept)->first();
                if (!$curr_dept) {
                    // création d'un nouveau département
                    $curr_dept = Departement::create([
                        'intitule' => $dept,
                        'statut_id' => Statut::actif()->first()->id,
                    ]);
                    // Recherche du type de dépertement en fonction de l'intitulé
                    $type_dpt_id = $this->parseDepartementType($dept);
                    if ($type_dpt_id) {
                        $curr_dept->type_departement_id = $type_dpt_id;
                    }
                }
                // Set du parent du précédent
                if ($prev_dept) {
                    $prev_dept->departement_parent_id = $curr_dept->id;
                    $prev_dept->save();
                } else {
                    $first_dept = $curr_dept;
                }
                $curr_dept->description = $dept;
                $curr_dept->save();
                // On assigne le précédent
                $prev_dept = $curr_dept;
            }
        }
        return $first_dept;
    }

    /**
     * Essaie de déduire le type d'un département
     * @param $intitule string intitulé du département
     * @return |null
     */
    private function parseDepartementType(string $intitule) {
        if (strpos(strtolower($intitule), 'direction') !== false) {
            $type = TypeDepartement::where('intitule', 'Direction')->first();
            return $type->id;
        } elseif (strpos(strtolower($intitule), 'division') !== false) {
            $type = TypeDepartement::where('intitule', 'Division')->first();
            return $type->id;
        } elseif (strpos(strtolower($intitule), 'zone') !== false) {
            $type = TypeDepartement::where('intitule', 'Zone')->first();
            return $type->id;
        } elseif (strpos(strtolower($intitule), 'service') !== false) {
            $type = TypeDepartement::where('intitule', 'Service')->first();
            return $type->id;
        } elseif (strpos(strtolower($intitule), 'agence') !== false) {
            $type = TypeDepartement::where('intitule', 'Agence')->first();
            return $type->id;
        } else {
            return null;
        }
    }

    /**
     * Formate l'intitulé d'un département
     * @param string $intitule
     * @return string
     */
    private function formatDepartementIntitule(string $intitule) {
        $sigles = ['gt','rh','si','it'];
        $intitule_tab = explode(' ', $intitule);

        for ($i = 0; $i < count($intitule_tab); $i++) {
            // Mettre en minuscules
            $intitule_tab[$i] = strtolower($intitule_tab[$i]);

            // Replaces: tous les sigles
            foreach ($sigles as $sigle) {
                if (strlen($intitule_tab[$i]) == strlen($sigle)) {
                    $intitule_tab[$i] = str_replace(strtolower($sigle), strtoupper($sigle), $intitule_tab[$i]);
                }
            }

            // Mettre les debuts de mot en Majuscule
            $firs_car = substr($intitule_tab[$i], 0, 1);
            if (ctype_alpha($firs_car)) {
                // Le 1er caractère est alphabétique
                $intitule_tab[$i] = ucwords($intitule_tab[$i]);
            } else {
                // Le 1er caractère n'est alphabétique
                // Alors on met 1er caractère du reste en Majuscule
                $intitule_tab[$i] = $firs_car . ucwords(substr($intitule_tab[$i], 1, strlen($intitule_tab[$i]) - 1));
            }

            // Les sigles entre parenthèses
            if ( (substr($intitule_tab[$i], 0, 1) === "(") && (substr($intitule_tab[$i], -1) === ")") && (strlen($intitule_tab[$i]) <= 7) ) {
                $intitule_tab[$i] = strtoupper($intitule_tab[$i]);
            }
        }
        $intitule = implode(' ', $intitule_tab);
        return $intitule;
    }

    /**
     * Créer un compte d'accès à l'application
     * @param \App\LdapAccount $ldapaccount
     */
    private function createUser(LdapAccount $ldapaccount) {
        if (! User::where('ldapaccount_id', $ldapaccount->id)->first()) {
            User::create([
                'name' => $ldapaccount->name,
                'email' => $ldapaccount->mail,
                'is_ldap' => true,
                'ldapaccount_id' => $ldapaccount->id,
                'statut_id' => Statut::inactif()->first()->id,
                'password' => bcrypt('gestocksecret')
            ]);
        }
    }
}