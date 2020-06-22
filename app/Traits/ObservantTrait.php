<?php

namespace App\Traits;

use App\Observers\AppBaseModelObserver;

trait ObservantTrait
{
    public static function bootObservantTrait()
    {
        static::observe(new AppBaseModelObserver);
    }
}
