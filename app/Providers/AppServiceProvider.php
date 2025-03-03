<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CakeDayService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(CakeDayService::class, function ($app) {
            return new CakeDayService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
