<?php

namespace App\Providers;

use Blade;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::directive('translate', function ($expression) {
            return "<?php echo __translate($expression); ?>";
        });

        Blueprint::macro('currentTimestamps', function () {
            $this->timestamp('created_at')->useCurrent();
            $this->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Collection::macro('calculateStats', function () {
            return $this->map(function ($value) {
                $value->stats = $value->stats();
                return $value;
            });
        });

    }
}
