<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

// Definē TableSeeder klasi, kas manto no Seeder bāzes klases.
class TableSeeder extends Seeder
{
    // Metode, kas izpilda datu pievienošanas operācijas.
    public function run()
    {
        // Definē galdu sarakstu ar to numuriem, rezervācijas statusu un sēdvietu skaitu.
        $tables = [
            ['table_number' => 1, 'is_reserved' => false, 'seats' => 4],
            ['table_number' => 2, 'is_reserved' => true, 'seats' => 4],
            ['table_number' => 3, 'is_reserved' => false, 'seats' => 6],
            ['table_number' => 4, 'is_reserved' => false, 'seats' => 6],
            ['table_number' => 5, 'is_reserved' => false, 'seats' => 8],
            ['table_number' => 6, 'is_reserved' => false, 'seats' => 8],
            ['table_number' => 7, 'is_reserved' => false, 'seats' => 2],
            ['table_number' => 8, 'is_reserved' => false, 'seats' => 2],
            ['table_number' => 9, 'is_reserved' => false, 'seats' => 4],
            ['table_number' => 10, 'is_reserved' => true, 'seats' => 4],
            ['table_number' => 11, 'is_reserved' => false, 'seats' => 10],
            ['table_number' => 12, 'is_reserved' => false, 'seats' => 10],
        ];

        // Cikls, kas iziet cauri katram galdam un pievieno to datu bāzei.
        foreach ($tables as $table) {
            // Izveido jaunu galdu, izmantojot datus no saraksta.
            Table::create($table);
        }
    }
}

