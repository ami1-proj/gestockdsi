<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;
use App\Traits\PermissionTrait;
use App\Traits\AppBaseTrait;
use App\Traits\RecycleBinTrait;
use App\Traits\ObservantTrait;
use App\Traits\StatutTrait;
use App\Traits\RelationshipsTrait;

/**
 * Class User
 * @package App
 *
 * @property integer $id
 * @property string $objectguid
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property string $password
 * @property string $image
 * @property boolean $is_local
 * @property boolean $is_ldap
 * @property integer $statut_id
 * @property integer $ldapaccount_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use PermissionTrait;
    use AppBaseTrait;
    use RecycleBinTrait;
    use ObservantTrait;
    use StatutTrait;
    use RelationshipsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'statut_id', 'image', 'is_local', 'is_ldap', 'ldapaccount_id', 'username', 'objectguid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $model_name = 'User';

    public static $view_folder = 'users';
    public static $view_fields = 'users.fields';
    public static $view_table_values = 'users.table_values';
    public static $view_table_headers = 'users.table_headers';
    public static $view_morecontrols = ['users.roles_control'];
    public static $view_moreforms = [];

    public static $var_name_single = 'user';
    public static $unique_fields = [];

    public static $det_sing = 'l’';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'de l’';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'utilisateur';
    public static $title_plu = 'utilisateurs';

    public static $route_index = 'UserController@index';
    public static $route_create = 'UserController@create';
    public static $route_store = 'UserController@store';
    public static $route_show = 'UserController@show';
    public static $route_edit = 'UserController@edit';
    public static $route_update = 'UserController@update';
    public static $route_destroy = 'UserController@destroy';

    public static $breadcrumb_index = 'users';
    public static $breadcrumb_create = 'users.create';
    public static $breadcrumb_show = 'users.show';
    public static $breadcrumb_edit = 'users.edit';

    public static $denomination_field = 'name';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public static function defaultRules() {
      return [
          'name' => ['required',],
          'roles' => ['required'],
        ];
    }
    public static function createRules() {
      return array_merge(self::defaultRules(), [
        'email' => ['required','email','unique:users,email'],
        'password' => ['required','same:confirm_password'],
      ]);
    }
    public static function updateRules($model) {
      return array_merge(self::defaultRules(), [
          'email' => ['required','email','unique:users,email,'.$model->id,],
      ]);
    }
    public static function validationMessages() {
      return [];
    }

    /**
     * Renvoie le Compte LDAP du User.
     */
    public function ldapaccount() {
        return $this->belongsTo('App\LdapAccount', 'ldapaccount_id');
    }

    /**
     * Renvoie le Statut du User.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      return $query
        ->where('name', 'LIKE', "%{$q}%")
        ->orWhere('email', 'LIKE', "%{$q}%")
        ;
    }

    private function setUsername() {
        if (empty($this->username)) {
            $this->username = explode('@', $this->email)[0];
        }
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->setUsername();
        });

        self::created(function($model){
            // ... code here
        });

        self::updating(function($model){
            $model->setUsername();
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }
}
