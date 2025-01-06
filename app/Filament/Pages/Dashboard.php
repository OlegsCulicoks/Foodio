<?php


namespace App\Filament\Pages;

// Importē nepieciešamos modeļus no datubāzes
use App\Models\MenuItem;
use App\Models\Reservation;
use App\Models\Table;

// Importē Filament bāzes klases
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;


//Dashboard klase, kas veido galveno statistikas skatu.
//Paplašina Filament pamatklasi BaseDashboard.
class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            DashboardStatsOverview::class,
        ];
    }
}

//Iegūst statistikas datus priekš Dashboard.
class DashboardStatsOverview extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            // Kopējais ēdienu vienumu skaits
            Stat::make('Total Menu Items', MenuItem::count()),
            // Brīvo galdu skaits, kur "is_reserved" ir false kas nozime ka galds nav rezervets
            Stat::make('Available Tables', Table::where('is_reserved', false)->count()),
            // Gaidāmo rezervāciju skaits, kur datums ir tagadnē vai nākotnē
            Stat::make('Upcoming Reservations', Reservation::where('reservation_date', '>=', now())->count()),
        ];
    }
}

