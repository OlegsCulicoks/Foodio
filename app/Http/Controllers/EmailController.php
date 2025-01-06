<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

// EmailController klase atbild par kontakta formas apstrādi un e-pasta nosūtīšanu.
class EmailController extends Controller
{
    // Nosūta e-pastu, pamatojoties uz lietotāja ievadītajiem datiem.
    public function send(Request $request)
    {
        // Validē ievades datus
        $request->validate([
            'name' => 'required|string|max:100', // Obligāts vārds, maksimālais garums 100
            'email' => 'required|email|max:100', // Obligāts derīgs e-pasts, maksimālais garums 100
            'message' => 'required|string', // Obligāta ziņa kā teksts
        ]);

        try {
            // Nosūta e-pastu uz norādīto adresi, izmantojot ContactFormMail klasi
            Mail::to('culicoksolegs@gmail.com')->send(new ContactFormMail($request->all()));

            // Ieraksta veiksmīgas nosūtīšanas informāciju (log failā)
            Log::info('Email sent successfully', ['email' => $request->email]);

            // Novirza lietotāju atpakaļ uz mājaslapu ar veiksmīgu ziņojumu
            return redirect()->route('home')->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            //Ja rodas kļūda e-pasta nosūtīšanas laikā, tiek veikta kļūdu apstrāde

            // Ieraksta kļūdas informāciju log faila (ar kļūdas ziņojumu un detalizētu informāciju)
            Log::error('Failed to send email', [
                'error' => $e->getMessage(), // Saglabā kļūdas ziņojumu, kas apraksta, kāpēc e-pasta nosūtīšana neizdevās
                'trace' => $e->getTraceAsString() // Saglabā izsaukumu kaudzes izsekošanu kā tekstu, lai palīdzētu identificēt, kur radās kļūda
            ]);

            // Novirza lietotāju atpakaļ uz mājaslapu ar kļūdas paziņojumu
            return redirect()->route('home')->with('error', 'Sorry, there was an error sending your message. Please try again later. Error: ' . $e->getMessage());
        }
    }
}

