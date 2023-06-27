<?php

namespace App\Providers;

use Illuminate\Support\Facades\App; // 追加
use Illuminate\Support\Facades\URL; // 追加
use Illuminate\Support\ServiceProvider;

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
    public function boot() {
        if (App::environment('production','staging')) {
            URL::forceScheme('https');
        }
        if (request()->is('admin/*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
    }
}
