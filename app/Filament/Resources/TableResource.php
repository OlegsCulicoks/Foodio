<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableResource\Pages;
use App\Models\Table as TableModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table as FilamentTable;

//TableResource klase, lai pārvaldītu galdiņu resursus administrācijas panelī.
class TableResource extends Resource
{
    //Resursam piesaistītais modelis.
    protected static ?string $model = TableModel::class;

    //Navigācijas ikona, kas parādās administrācijas panelī.
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    //Konfigurē veidlapu galdiņa datu izveidei vai rediģēšanai.
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Teksta lauks priekš galdiņa numura
                Forms\Components\TextInput::make('table_number')
                    ->required() //Obligāts lauks
                    ->numeric() //Atļauti ir tikai skaitļi
                    ->unique(ignoreRecord: true), //// Nodrošina unikālu vērtību, ignorējot aktuālo ierakstu
                // Slēdzis, lai norādītu, vai galdiņš ir rezervēts
                Forms\Components\Toggle::make('is_reserved')
                    ->required(),
                // Teksta lauks priekš sēdvietu skaita ar minimālo un maksimālo vērtību
                Forms\Components\TextInput::make('seats')
                    ->required()
                    ->numeric()
                    ->minValue(1) //Minimala vertiba ir 1
                    ->maxValue(20), // Maksimala vertiba ir 20
            ]);
    }

    //Konfigurē tabulu, lai parādītu galdiņu datus.
    public static function table(FilamentTable $table): FilamentTable
    {
        return $table
            ->columns([
                // Kolonna priekš galdiņa numura ar kārtošanas funkcionalitāti
                Tables\Columns\TextColumn::make('table_number')
                    ->sortable(),
                // Ikonas kolonna, lai parādītu, vai galdiņš ir rezervēts
                Tables\Columns\IconColumn::make('is_reserved')
                    ->boolean(), // Attēlo "true/false" kā keksiti vai krustinu
                // Kolonna priekš sēdvietu skaita ar iespēju kārtot
                Tables\Columns\TextColumn::make('seats')
                    ->sortable(),
            ])
            ->filters([
                // Filtrs, lai atlasītu galdiņus pēc rezervācijas statusa
                Tables\Filters\SelectFilter::make('is_reserved')
                    ->options([
                        '0' => 'Available', //Galdini kas nav rezerveti
                        '1' => 'Reserved', //Galdini kas ir jau rezerveti
                    ]),
            ])
            ->actions([
                //Darbība rediģēšana
                Tables\Actions\EditAction::make(),
                //Darbība dzēšana
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Masveida darbību grupēšana, kas ietver dzēšanu
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Definē relācijas, kas saistītas ar šo resursu.
    public static function getRelations(): array
    {
        return [
            // Šeit var pievienot relācijas, ja nepieciešams
        ];
    }

    // Definē lapas, kas saistītas ar šo resursu.
    public static function getPages(): array
    {
        return [
            // Lapa, kas parāda visu galdiņu sarakstu
            'index' => Pages\ListTables::route('/'),
            // Lapa, lai izveidotu jaunu galdiņu ierakstu
            'create' => Pages\CreateTable::route('/create'),
            // Lapa, lai rediģētu konkrētu galdiņu ierakstu
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }
}

