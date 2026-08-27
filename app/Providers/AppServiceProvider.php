<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Bagikan variabel $settings ke seluruh view, di-cache selama 1 minggu
        view()->composer('*', function ($view) {
            $settings = \Illuminate\Support\Facades\Cache::remember('global_settings', 604800, function () {
                return \App\Models\Pengaturan::pluck('nilai', 'kunci')->toArray();
            });
            $view->with('settings', $settings);
        });
    }
}
