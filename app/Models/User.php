<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

    // Definē User klasi, kas manto no Authentikācijas modeļa.
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Ietver HasApiTokens, HasFactory un Notifiable funkcionalitātes.

    // Norāda, kuras lauku vērtības var masveidā piešķirt (fillable) modeļa izveidošanas un atjaunošanas laikā.
    protected $fillable = [
        'name', // Lietotāja vārds.
        'email', // Lietotāja e-pasta adrese.
        'password', // Lietotāja parole.
        'is_admin', // Norāda, vai lietotājs ir administrators.
    ];

    // Norāda, kuri lauki tiek paslēpti, kad modelis tiek pārveidots uz masīvu vai JSON.
    protected $hidden = [
        'password', // Paslēpj paroli.
        'remember_token', // Paslēpj atcerēšanās tokenu, ja lietotājs ir izvēlējies palikt pierakstīts.
    ];

    // Norāda noteiktus atribūtus, lai automātiski konvertētu to vērtības.
    protected $casts = [
        'email_verified_at' => 'datetime', // Konvertē 'email_verified_at' lauku uz datetime tipu.
        'is_admin' => 'boolean',  // Konvertē 'is_admin' lauku uz boolean tipu.
    ];

    // Definē attiecību, kurā lietotājs var būt vairākām rezervācijām.
    public function reservations()
    {

        return $this->hasMany(Reservation::class);
    }
}

