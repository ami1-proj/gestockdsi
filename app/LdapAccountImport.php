<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class LdapAccountImport
     * @package App
     *
     * @property integer $id
     * @property string|null $objectguid
     * @property string|null $username
     * @property string|null $name
     * @property string|null $email
     * @property string|null $password
     */
    class LdapAccountImport extends Model
    {
        protected $guarded = [];
        protected $table = 'ldapaccountimports';
    }
