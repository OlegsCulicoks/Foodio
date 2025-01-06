<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Definē DatabaseSeeder klasi, kas manto no bāzes Seeder klases.
class DatabaseSeeder extends Seeder
{
    // Metode, kas tiek izsaukta, kad jāveic datu ieejas operācijas.
    public function run()
    {
        // Izsauc metodi call, lai izsauktu citas seeder klases, kas iepilda datus.
        $this->call([
            UserSeeder::class, // Izsauc UserSeeder, kas atbild par lietotāju datu ieeju.
            TableSeeder::class, // Izsauc TableSeeder, kas iepilda tabulu datus.
            MenuItemSeeder::class, // Izsauc MenuItemSeeder, kas iepilda ēdienu datu ieeju.
            ReservationSeeder::class, // Izsauc ReservationSeeder, kas iepilda rezervāciju datus.
        ]);
    }
}
