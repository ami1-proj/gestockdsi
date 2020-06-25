<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ldapimport extends Model
{
    protected $guarded = [];
    protected $table = 'ldapimports';

    public function getTableColumns() {
        //$columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        $columns  = \Schema::getColumnListing($this->getTable());
        //$columns = \DB::getSchemaBuilder()->getColumnListing($this->getTable());

        return $columns;
    }

    public function getLdapColumns() {
        $ldap_cols = [];
        foreach ($this->getTableColumns() as $col) {
            if (substr($col, 0, 5) === "ldap_") {
                $ldap_cols[] = str_replace($col, "", "ldap_");
            }
        }
        return $ldap_cols;
    }
}
