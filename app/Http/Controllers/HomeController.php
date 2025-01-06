<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Funkcija, kas tiek izsaukta, lai parādītu mājas lapas saturu
    public function index()
    {
        // Definē iemeslus, kāpēc izvēlēties šo restorānu
        $reasons = [
            ['title' => 'Excellent flavors and quality products', 'description' => 'We use only the highest quality products so that every dish is fresh, tasty and enjoyable.'],
            ['title' => 'Easy table reservation', 'description' => 'Our convenient booking process makes it easy and quick to secure a table in our restaurant.'],
            ['title' => 'Seasonal menu and new flavors', 'description' => 'Our menu is regularly updated with seasonal dishes that reflect the best flavors of each time of the year.'],
        ];

        // Definē atsauksmes no klienta
        $feedback = [
            'text' => 'The menu was varied, and each dish was well thought out and extremely tasty. I like to visit this restaurant, because this restaurant is the best.',
            'name' => 'Andra Krastina',
            'title' => 'Our best guest',
        ];

        // Statistika par restorāna popularitāti
        $stats = [
            'loves' => 150, // Klientu skaits kuriem patik restorans
            'awards' => 10, //Ieguto balvu skaits
        ];

        // Atgriež skatu ar definētajiem datiem
        return view('home', compact('reasons', 'feedback', 'stats')); // Iesniedz skatu 'home', nododot tam iemeslus, atsauksmes un statistiku
    }
}

