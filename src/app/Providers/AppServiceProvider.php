<?php

namespace App\Providers;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::enableQueryLog();
        Model::preventLazyLoading();

        if (app()->environment('production')) {
            DB::connection()->enableQueryCache(60); // Cache 60 detik
        }
    }
}
