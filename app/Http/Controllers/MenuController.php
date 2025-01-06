<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

// Definē MenuController klasi, kas izmanto Controller klases
class MenuController extends Controller
{
    // Šī metode atgriež visus ēdienus, grupējot tos pēc kategorijas
    public function index()
    {
        // Iegūst visus ēdienus no datu bāzes un grupē tos pēc 'category' laukā
        $menuItems = MenuItem::all()->groupBy('category');

        // Atgriež skatu 'menu', nododot tajā grupētos ēdienus
        return view('menu', compact('menuItems'));
    }
}

