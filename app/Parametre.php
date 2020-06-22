<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PermissionTrait;

class Parametre extends Model
{
    use PermissionTrait;

    public static $model_name = 'Parametre';
}
