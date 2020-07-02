<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AppBaseModel;
use App\Observers\AppBaseModelObserver;
use App\Article;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * tell Laravel that, when the App boots,
         * which is after all other Services are already registered,
         * we are gonna add to the config array our own settings
         */
        config([
            'settings' => Setting::getAllGrouped()
        ]);
    }
}
