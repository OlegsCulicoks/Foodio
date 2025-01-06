<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model // Definē MenuItem klasi, kas izmanto no Eloquent Model klases.
{
    // Izslēdz automātisko 'created_at' un 'updated_at' lauku izsekošanu.
    public $timestamps = false;

    // Norāda, kuras lauku vērtības var masveidā piešķirt (fillable) modeļa izveidošanas un atjaunošanas laikā.
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
    ];

    // Setter metode, lai iestatītu 'image' lauka vērtību.
    public function setImageAttribute($value)
    {
        // Ja tiek nodota vērtība, saglabā tikai faila nosaukumu (no ceļa); ja nē, iestata null.
        $this->attributes['image'] = $value ? basename($value) : null;
    }

    // Getter metode, lai iegūtu 'image' lauka vērtību.
    public function getImageAttribute($value)
    {
        // Atgriež attēla ceļu, ja tas ir definēts, pretējā gadījumā atgriež null.
        return $value ? "{$value}" : null;
    }

    // Definē attiecības starp ēdienu un rezervācijām.
    public function reservations()
    {
        // Šī metode definē daudzas uz daudzas attiecības ar rezervāciju modeli,
        // izmantojot 'reservation_menu' pivot tabulu, kas satur papildu informāciju, piemēram, 'quantity'.
        return $this->belongsToMany(Reservation::class, 'reservation_menu')->withPivot('quantity');
    }
}

