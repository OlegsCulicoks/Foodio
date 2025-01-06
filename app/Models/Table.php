<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model // Definē Table klasi, kas manto no Eloquent Model klases.
{
    use HasFactory; // Ietver HasFactory, lai izmantotu modeļa fabriku datu bāzes ierakstu ģenerēšanai.

    // Norāda, kuras lauku vērtības var masveidā piešķirt (fillable) modeļa izveidošanas un atjaunošanas laikā.
    protected $fillable = [
        'table_number', // Tabulas numurs, kas identificē konkrētu tabulu.
        'is_reserved', // Norāda, vai tabula ir rezervēta (boolean) true/false true-brivs false-rezervets.
        'seats', // Tabulas sēdvietu skaits.
    ];

    // Norāda, kā tipizēt noteiktus atribūtus, lai automātiski konvertētu to vērtības.
    protected $casts = [
        'is_reserved' => 'boolean', // Konvertē 'is_reserved' lauku uz boolean tipu.
    ];

    // Norāda, ka jāizmanto automātiskā lauku izsekošana ('created_at' un 'updated_at').
    public $timestamps = true;
}

