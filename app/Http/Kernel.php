<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Middleware, kas tiek izpildīts visiem pieprasījumiem
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class, // Middleware, kas uztic proxy serveriem
        \Illuminate\Http\Middleware\HandleCors::class, // Middleware, kas apstrādā CORS (Cross-Origin Resource Sharing) pieprasījumus
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // Novērš pieprasījumus, kad lietojumprogramma ir uzturēšanas režīmā
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // Middleware, kas pārbauda POST pieprasījumu izmēru
        \App\Http\Middleware\TrimStrings::class, // Attīra virknes (noņem liekos tukšumus)
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Pārvērš tukšas virknes uz null
    ];

    // Middleware grupas, kas tiek izmantotas pieprasījumiem
    protected $middlewareGroups = [
        'web' => [ // Grupa, kas tiek izmantota web pieprasījumiem
            \App\Http\Middleware\EncryptCookies::class, // Middleware, kas šifrē sīkdatnes
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Pievieno iepriekšējās sīkdatnes atbildē
            \Illuminate\Session\Middleware\StartSession::class, // Sāk sesiju
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Dalās ar kļūdām no sesijas
            \App\Http\Middleware\VerifyCsrfToken::class, // Pārbauda CSRF token
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Aizstāj ceļu saistības
        ],

        'api' => [ // Grupa, kas tiek izmantota API pieprasījumiem
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // (Pagaidām izslēgts) nodrošina stāvokļa uzturēšanu frontend pieprasījumos
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api', // Ierobežo pieprasījumu skaitu API
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Aizstāj ceļu saistības
        ],
    ];

    // Atsevišķi middleware, ko var izmantot maršrutu definīcijās
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Middleware, kas autentificē lietotāju
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,  // Middleware, kas izmanto pamata autentifikāciju
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, // Middleware, kas autentificē sesijas
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,  // Middleware, kas iestata kešatmiņas virsrakstus
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Middleware, kas autorizē lietotāju rīcību
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Novirza viesus, ja viņi jau ir autentificēti
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // Pieprasa paroli, lai turpinātu
        'signed' => \App\Http\Middleware\ValidateSignature::class, // Pārbauda, vai pieprasījums ir parakstīts
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Ierobežo pieprasījumus
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Pārbauda, vai lietotāja e-pasts ir apstiprināts
        'admin' => \App\Http\Middleware\AdminMiddleware::class, // Middleware, kas nodrošina piekļuvi administratoriem
    ];
}

