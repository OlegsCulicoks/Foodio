<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;

// Definē ReservationSeeder klasi, kas manto no Seeder bāzes klases.
class ReservationSeeder extends Seeder
{
    // Metode, kas izpilda datu pievienošanas operācijas.
    public function run()
    {
        // Meklē lietotāju ar norādīto e-pasta adresi.
        $user = User::where('email', 'tests@gmail.com')->first();

        // Definē rezervāciju sarakstu.
        $reservations = [
            [
                'user_id' => $user->id, // Lietotāja ID, kas veic rezervāciju.
                'reservation_date' => '2024-11-22', // Rezervācijas datums.
                'reservation_time' => '15:38:00', // Rezervācijas laiks.
                'guest_count' => 2, // Viesu skaits rezervācijā.
                'table_id' => 2, // ID tabulai, kurai rezervācija tiek veikta.
            ],
            [
                'user_id' => $user->id, // Lietotāja ID, kas veic rezervāciju.
                'reservation_date' => '2024-11-25', // Rezervācijas datums.
                'reservation_time' => '13:08:00', // Rezervācijas laiks.
                'guest_count' => 2, // Viesu skaits rezervācijā.
                'table_id' => 10, // ID tabulai, kurai rezervācija tiek veikta.
            ],
        ];

        // Cikls, kas iziet cauri katrai rezervācijai un pievieno to datu bāzei.
        foreach ($reservations as $reservationData) {
            // Izveido jaunu rezervāciju, izmantojot datus no saraksta.
            $reservation = Reservation::create($reservationData);

            // Pievieno ēdienus rezervācijai, pamatojoties uz rezervācijas ID.
            if ($reservation->id == 59) { // Ja rezervācijas ID ir 59
                // Pievieno ēdienu ar ID 1 un tā daudzumu.
                $reservation->menuItems()->attach(1, ['quantity' => 1]);
            } elseif ($reservation->id == 60) { // Ja rezervācijas ID ir 60,
                // Pievieno vairākus ēdienus ar to attiecīgajiem daudzumiem.
                $reservation->menuItems()->attach([
                    1 => ['quantity' => 1], // Ēdiens ar ID 1 ar daudzumu 1.
                    4 => ['quantity' => 1], // Ēdiens ar ID 4 ar daudzumu 1.
                    5 => ['quantity' => 1], // Ēdiens ar ID 5 ar daudzumu 1.
                ]);
            }
        }
    }
}

