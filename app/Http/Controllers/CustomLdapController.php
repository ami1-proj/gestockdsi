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
    	$this->adldapGetUsers();
    }

    public function sync() {
        $this->importLdapAccounts();
    }
}
