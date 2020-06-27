<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LdapCustom\LdapConnectTrait;
use App\LdapCustom\LdapImportTrait;

class CustomLdapController extends Controller
{
	use LdapConnectTrait, LdapImportTrait;

    public function test()
    {
    	$ldapuser = $this->ldapGetUserByName("Flore OWONDEAULT BERRE");
    	dd($ldapuser);
    }

    public function sync() {
        $this->importLdapAccounts();
    }
}
