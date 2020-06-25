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
}
