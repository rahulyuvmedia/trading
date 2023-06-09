<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

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
        $setting = false;
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            View::share('app_settings', $setting);
        }

        $year = date('Y');
        $running_year = $year . '-' . ($year + 1);
        $running_session = $setting ? $setting->running_year : $running_year;

        config(['running_session' => $running_session]);
        //check that app is local
if ($this->app->isLocal()) {
    //if local register your services you require for development
        $this->app->register('Barryvdh\Debugbar\ServiceProvider');
    } else {
    //else register your services you require for production
        $this->app['request']->server->set('HTTPS', true);
    }
    }
}
