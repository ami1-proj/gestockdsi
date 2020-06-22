<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\PermissionTrait;
use App\Traits\AppBaseTrait;
use App\Traits\RecycleBinTrait;
use App\Traits\ObservantTrait;
use App\Traits\StatutTrait;
use App\Traits\RelationshipsTrait;


class AppBaseModel extends Model
{
    use PermissionTrait;
    use AppBaseTrait;
    use RecycleBinTrait;
    use ObservantTrait;
    use StatutTrait;
    use RelationshipsTrait;

    public static $model_name = 'AppBaseModel';

    public function getDenominationAttribute() {
        return $this->getDenominationAttribute();
    }
}
