<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model // Definē Reservation klasi, kas izmanto no Eloquent Model klases.
{
    // Izslēdz automātisko 'updated_at' lauka izsekošanu, lai neveidotu šādu lauku šajā modelī.
    const UPDATED_AT = null;

    // Norāda, kuras lauku vērtības var masveidā piešķirt (fillable) modeļa izveidošanas un atjaunošanas laikā.
    protected $fillable = [
        'user_id', // Lietotāja ID, kas veica rezervāciju
        'reservation_date',  // Rezervācijas datums
        'reservation_time', // Rezervācijas laiks
        'guest_count', // Apmeklētāju skaits rezervācijā
        'table_id', // ID tabulai, kurai ir rezervācija
    ];

    // Definē attiecības starp rezervāciju un lietotāju.
    public function user()
    {
        // Šī metode norāda, ka katra rezervācija pieder lietotājam.
        return $this->belongsTo(User::class);
    }

    // Definē attiecības starp rezervāciju un tabulu.
    public function table()
    {
        // Šī metode norāda, ka katra rezervācija ir saistīta ar konkrētu tabulu.
        return $this->belongsTo(Table::class);
    }

    // Definē attiecības starp rezervāciju un ēdieniem.
    public function menuItems()
    {
        // Šī metode norāda, ka rezervācija var ietvert vairākus ēdienus,
        // izmantojot 'reservation_menu' pivot tabulu, kas satur papildu informāciju, piemēram, 'quantity'.
        return $this->belongsToMany(MenuItem::class, 'reservation_menu')->withPivot('quantity');
    }
}

