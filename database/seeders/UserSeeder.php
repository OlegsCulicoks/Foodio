<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Definē UserSeeder klasi, kas manto no Seeder bāzes klases.
class UserSeeder extends Seeder
{
    // Metode, kas izpilda datu pievienošanas operācijas.
    public function run()
    {
        // Izveido pirmo lietotāju ar nosaukumu 'Olegs' un e-pasta adresi, šifrējot paroli.
        User::create([
            'name' => 'Olegs',
            'email' => 'culicoksolegs@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Izveido otro lietotāju ar nosaukumu 'Skrundas_Iedzivotajs' un e-pasta adresi, šifrējot paroli.
        User::create([
            'name' => 'Skrundas_Iedzivotajs',
            'email' => 'tests@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}

