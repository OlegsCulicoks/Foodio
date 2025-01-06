<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;

class ReservationStepperController extends Controller
{
    // Rāda pirma soļa skatu rezervācijas procesā
    public function showStep1()
    {
        return view('reservations.step1');
    }

    // Apstrādā pirmā soļa datus, kas tiek nosūtīti ar pieprasījumu
    public function postStep1(Request $request)
    {
        // Validē pieprasījumā saņemtos datus
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Vārds ir obligāts, ir jābūt string un maksimālais garums 255
            'email' => 'required|email|max:255', // E-pasts ir obligāts, jābūt derīgam e-pasta formātā un maksimālais garums 255
        ]);

        // Iestata rezervācijas datumu uz rītdienu un laiku uz 19:00
        $validatedData['reservation_date'] = Carbon::tomorrow()->format('Y-m-d');
        $validatedData['reservation_time'] = '19:00';

        // Saglabā validētos datus sesijā, lai tie būtu pieejami nākamajos soļos
        $request->session()->put('reservation_data', $validatedData);

        // Novirza uz otro soli
        return redirect()->route('reservations.step2');
    }

    // Rāda otrā soļa skatu, kur izvēlas galdu
    public function showStep2()
    {
        // Iegūst pieejamos galdus, kas nav rezervēti
        $tables = Table::where('is_reserved', false)->get();
        return view('reservations.step2', compact('tables')); // Atgriež skatu 'step2', nododot pieejamo galdu sarakstu
    }

    // Apstrādā otrā soļa datus, kas tiek nosūtīti ar pieprasījumu
    public function postStep2(Request $request)
    {
        // Validē pieprasījumā saņemtos datus
        $validatedData = $request->validate([
            'guest_count' => 'required|integer|min:1|max:10', // Viesu skaitam jābūt obligātam, vesela skaitļa formātā, starp 1 un 10
            'table_id' => 'required|exists:tables,id', // Galda ID ir obligāts un jābūt esošam tabulā
        ]);

        // Iegūst datus no sesijas un pievieno jaunos validētos datus
        $reservationData = session('reservation_data');
        $reservationData = array_merge($reservationData, $validatedData);
        session(['reservation_data' => $reservationData]); // Atjaunina sesiju ar jauniem datiem

        // Novirza uz trešo soli
        return redirect()->route('reservations.step3');
    }

    // Rāda treša soļa skatu, kur izvēlas ēdienus
    public function showStep3()
    {
        $guestCount = session('reservation_data.guest_count', 1); // Iegūst viesu skaitu no sesijas, noklusējuma 1
        $menuItems = MenuItem::all()->groupBy('category'); // Iegūst visus ēdienus un grupē tos pēc kategorijas

        // Atgriež skatu 'step3', nododot viesu skaitu un ēdienus
        return view('reservations.step3', compact('guestCount', 'menuItems'));
    }

    // Apstrādā trešā soļa datus, kas tiek nosūtīti ar pieprasījumu
    public function postStep3(Request $request)
    {
        // Validē pieprasījumā saņemtos datus
        $validatedData = $request->validate([
            'meals' => 'required|array', // Ēdienu izvēle ir obligāta, jābūt masīvam
            'meals.*' => 'required|array',  // Apstiprina, ka katram viesim jābūt masīvam, kas satur viņu izvēlētos ēdienus.
            'meals.*.*' => 'required|exists:menu_items,id', // Pārbauda katra konkrētā ēdiena identifikatoru, kas ir izvēlēts katram viesim, un nodrošina, ka tas eksistē datu bāzē.
        ]);

        // Iegūst datus no sesijas un pievieno ēdienus
        $reservationData = session('reservation_data');
        $reservationData['meals'] = $validatedData['meals'];
        session(['reservation_data' => $reservationData]); // Atjaunina sesiju ar jauniem datiem


        // Novirza uz ceturto soli
        return redirect()->route('reservations.step4');
    }

    // Rāda ceturta soļa skatu, kur apstiprina rezervāciju
    public function showStep4()
    {
        $reservationData = session('reservation_data'); // Iegūst datus no sesijas

        // Ja datumi nav norādīti, iestata noklusējuma vērtības
        if (!isset($reservationData['reservation_date'])) {
            $reservationData['reservation_date'] = Carbon::tomorrow()->format('Y-m-d'); // Iestata datumu uz rītdienu
            session(['reservation_data' => $reservationData]); // Atjaunina sesiju
        }

        if (!isset($reservationData['reservation_time'])) {
            $reservationData['reservation_time'] = '19:00'; // Iestata laiku uz 19:00
            session(['reservation_data' => $reservationData]); // Atjaunina sesiju
        }

        // Iegūst unikālo izvēlēto ēdienu ID
        $selectedMenuItemIds = collect($reservationData['meals'])->flatten()->unique();
        // Iegūst izvēlētos ēdienus no datu bāzes
        $menuItems = MenuItem::whereIn('id', $selectedMenuItemIds)->get();
        // Iegūst galdu, kas ir rezervēts
        $table = Table::find($reservationData['table_id']);

        // Atgriež skatu 'step4', nododot rezervācijas datus, izvēlētos ēdienus un galdu
        return view('reservations.step4', compact('reservationData', 'menuItems', 'table'));
    }

    // Saglabā rezervāciju datu bāzē
    public function store(Request $request)
    {
        $reservationData = session('reservation_data'); // Iegūst datus no sesijas

        // Pārliecinās, ka visi obligātie dati ir pieejami
        if (!isset($reservationData['reservation_date'])) {
            $reservationData['reservation_date'] = Carbon::tomorrow()->format('Y-m-d'); // Iestata datumu uz rītdienu, ja tas nav norādīts
        }
        if (!isset($reservationData['reservation_time'])) {
            $reservationData['reservation_time'] = '19:00'; // Iestata laiku uz 19:00, ja tas nav norādīts
        }

        // Izveido jaunu rezervācijas objektu un pievieno datus
        $reservation = new Reservation();
        $reservation->name = $reservationData['name'];
        $reservation->email = $reservationData['email'];
        $reservation->reservation_date = $reservationData['reservation_date'];
        $reservation->reservation_time = $reservationData['reservation_time'];
        $reservation->guest_count = $reservationData['guest_count'];
        $reservation->table_id = $reservationData['table_id'];
        $reservation->save(); // Saglabā rezervāciju datu bāzē

        // Pievieno izvēlētos ēdienus rezervācijai
        foreach ($reservationData['meals'] as $guestMeals) {
            foreach ($guestMeals as $menuItemId) {
                $reservation->menuItems()->attach($menuItemId, ['quantity' => 1]); // Pievieno katru izvēlēto ēdienu ar kvantitāti 1
            }
        }

        // Atzīmē galdu kā rezervētu
        $table = Table::find($reservationData['table_id']);
        if ($table) {
            $table->is_reserved = true;  // Maina galda statusu uz rezervētu
            $table->save(); // Saglabā izmaiņas
        }

        // Notīra sesijas datus
        session()->forget('reservation_data');

        // Novirza uz rezervācijas apstiprinājuma skatu
        return redirect()->route('reservations.confirmation');
    }

    // Rāda rezervācijas apstiprinājuma skatu
    public function showConfirmation()
    {
        return view('reservations.confirmation'); // Atgriež skatu 'confirmation'
    }
}

