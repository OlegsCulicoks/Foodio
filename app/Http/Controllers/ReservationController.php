<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Funkcija, lai izveidotu jaunu rezervāciju
    public function create()
    {
        // Iegūst visus pieejamos galdus un ēdienus
        $tables = Table::all();
        $menuItems = MenuItem::all();

        // Atgriež skatu, kurā var izveidot rezervāciju, nododot galdus un ēdienus
        return view('reservations.create', compact('tables', 'menuItems'));
    }

    // Funkcija, lai saglabātu jauno rezervāciju
    public function store(Request $request)
    {
        //Validē pieprasījumā iekļautos datus
        $request->validate([
            'reservation_date' => 'required|date', // Datums ir obligāts un tam jābūt derīgam datumam
            'reservation_time' => 'required', // Laiks ir obligāts
            'guest_count' => 'required|integer|min:1|max:8', // Viesu skaits ir obligāts, jābūt skaitlim no 1 līdz 8
            'table_id' => 'required|exists:tables,id', // Galda ID ir obligāts un tam jābūt esošam galda ID
            'menu_items' => 'required|array', // Ēdiena elementu saraksts ir obligāts un jābūt masīvam
            'menu_items.*' => 'exists:menu_items,id', // Katram ēdiena elementam jābūt esošam
        ]);

        // Izveido jaunu rezervāciju ar norādītajiem datiem
        $reservation = Reservation::create([
            'user_id' => Auth::id(), // Saglabā autentificētā lietotāja ID
            'reservation_date' => $request->reservation_date, // Rezervācijas datums
            'reservation_time' => $request->reservation_time, // Rezervācijas laiks
            'guest_count' => $request->guest_count, // Viesu skaits
            'table_id' => $request->table_id, // Galda ID
        ]);

        // Pievieno izvēlētos ēdienus rezervācijai ar noklusējuma daudzumu 1
        foreach ($request->menu_items as $menuItemId) {
            $reservation->menuItems()->attach($menuItemId, ['quantity' => 1]);
        }

        // Atjaunina galda rezervācijas statusu
        $table = Table::find($request->table_id);
        $table->update(['is_reserved' => true]);

        // Pāradresē uz galveno lapu ar veiksmīgu rezervācijas ziņojumu
        return redirect()->route('home')->with('success', 'Your reservation has been successfully created!');
    }

    // Funkcija, lai parādītu lietotāja rezervāciju sarakstu
    public function index()
    {
        // Iegūst visus autentificētā lietotāja rezervācijas ar attiecīgajiem galdiem un ēdieniem
        $reservations = Auth::user()->reservations()->with(['table', 'menuItems'])->get();
        // Atgriež skatu ar rezervācijām
        return view('reservations.stepper', compact('reservations'));
    }

    // Funkcija, lai parādītu konkrētu rezervāciju
    public function show(Reservation $reservation)
    {
        // Pārbauda, vai lietotājam ir tiesības apskatīt rezervāciju
        $this->authorize('view', $reservation);
        // Atgriež skatu ar rezervāciju
        return view('reservations.show', compact('reservation'));
    }

    // Funkcija, lai rediģētu esošu rezervāciju
    public function edit(Reservation $reservation)
    {
        // Pārbauda, vai lietotājam ir tiesības rediģēt rezervāciju
        $this->authorize('update', $reservation);
        // Iegūst visus galdus un ēdienus, lai varētu rediģēt rezervāciju
        $tables = Table::all();
        $menuItems = MenuItem::all();
        // Atgriež skatu ar rezervācijas rediģēšanas formu
        return view('reservations.edit', compact('reservation', 'tables', 'menuItems'));
    }

    // Funkcija, lai atjauninātu esošu rezervāciju
    public function update(Request $request, Reservation $reservation)
    {
        // Pārbauda, vai lietotājam ir tiesības atjaunināt rezervāciju
        $this->authorize('update', $reservation);

        // Validē pieprasījumā iekļautos datus
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'guest_count' => 'required|integer|min:1|max:8',
            'table_id' => 'required|exists:tables,id',
            'menu_items' => 'required|array',
            'menu_items.*' => 'exists:menu_items,id',
        ]);

        // Saglabā veco galda ID, lai to varētu atjaunināt, ja nepieciešams
        $oldTableId = $reservation->table_id;

        // Atjaunina rezervācijas datus
        $reservation->update([
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'guest_count' => $request->guest_count,
            'table_id' => $request->table_id,
        ]);

        // Noņem visus iepriekšējos ēdienus no rezervācijas
        $reservation->menuItems()->detach();
        // Pievieno jaunus ēdienus ar noklusējuma daudzumu 1
        foreach ($request->menu_items as $menuItemId) {
            $reservation->menuItems()->attach($menuItemId, ['quantity' => 1]);
        }
        // Ja galds ir mainīts, atjaunina galdu rezervācijas statusu
        if ($oldTableId != $request->table_id) {
            Table::find($oldTableId)->update(['is_reserved' => false]);
            Table::find($request->table_id)->update(['is_reserved' => true]);
        }
        // Pāradresē uz rezervācijas skatu ar panākumu ziņu
        return redirect()->route('reservations.show', $reservation)->with('success', 'Your reservation has been successfully updated!');
    }

    // Funkcija, lai dzēstu rezervāciju
    public function destroy(Reservation $reservation)
    {
        // Pārbauda, vai lietotājam ir tiesības dzēst rezervāciju
        $this->authorize('delete', $reservation);

        // Iegūst galdu, kas saistīts ar rezervāciju, un atjaunina tā statusu
        $table = $reservation->table;
        $table->update(['is_reserved' => false]);

        // Dzēš rezervāciju
        $reservation->delete();

        // Pāradresē uz rezervāciju sarakstu ar veiksmīgu ziņojumu
        return redirect()->route('reservations.index')->with('success', 'Your reservation has been successfully cancelled.');
    }
}

