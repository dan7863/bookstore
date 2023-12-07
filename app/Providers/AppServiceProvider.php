<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        Blade::directive('available_state', function ($state) {
            return "<?php echo ($state == 1 ? 'Available' : 'Not Available') ?>";
        });

        Blade::directive('payment_method_state', function ($state) {
            return "<?php echo ($state == 1 ? 'Active' : 'Inactive') ?>";
        });
    }
}
