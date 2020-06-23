<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LdapCustom\LdapConnectTrait;

class CustomLdapController extends Controller
{
	use LdapConnectTrait;

    public function test()
    {
    	$this->adldapGetUsers();

    }
}
