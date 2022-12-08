<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
    public function boot()
    {
        Blade::directive('hryvnias', function ($expression) {
            return "<?php echo round($expression, 2) . ' грн'; ?>";
        });

        Blade::directive('dateonly', function ($expression) {
            return "<?php echo date_format($expression, 'Y.m.d'); ?>";
        });
    }
}
