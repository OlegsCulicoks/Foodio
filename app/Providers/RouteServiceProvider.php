<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // Ceļš uz home maršrutu.
    public const HOME = '/'; // Definē pastāvīgu konstanti, kas norāda home maršruta ceļu.

    // Definējiet maršrutu modeļa saistīšanas, parauga filtrus un citu maršrutu konfigurāciju.
    public function boot(): void // Pārliecinās, ka metode tiek izsaukta, kad pakalpojumu sniedzējs tiek inicializēts.
    {
        $this->configureRateLimiting(); // Izsauc metodi, lai konfigurētu likmes ierobežošanu.

        // Definē maršrutus, izmantojot slēgšanas funkciju.
        $this->routes(function () {
            Route::middleware('api') // Pievieno API
                ->prefix('api') // Nosaka URL prefiksu 'api' visiem maršrutiem šajā grupā.
                ->group(base_path('routes/api.php')); // Ielādē maršrutus no api.php faila.

            Route::middleware('web') // Pievieno web
                ->group(base_path('routes/web.php')); // Ielādē maršrutus no web.php faila.
        });
    }

   // Konfigurējiet likmju ierobežotājus lietotnei.
    protected function configureRateLimiting(): void // Definē metodi likmju ierobežošanas konfigurēšanai.
    {
        RateLimiter::for('api', function (Request $request) { // Izveido jaunu ierobežojumu grupu 'api'.
            // Ierobežo API pieprasījumus līdz 60 minūtē pēc lietotāja ID vai IP adreses.
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

