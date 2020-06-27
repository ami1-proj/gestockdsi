<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\LdapCustom\LdapImportTrait;

class LdapAccountSync extends Command
{
    use LdapImportTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ldapaccount:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise les comptes LDAP importés';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importLdapAccounts();
    }
}
