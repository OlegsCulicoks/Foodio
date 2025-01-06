<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


//MenuItemResource klase, kas konfigurē ēdienkartes vienumu pārvaldību.
class MenuItemResource extends Resource
{
    // ? nozīmē nullable vērtība var būt null.
    protected static ?string $model = MenuItem::class; // protected modifikators ļauj kontrolēt piekļuvi klases elementiem.

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    //Konfigurē veidlapu ēdienkartes izveidei vai rediģēšanai.
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Teksta lauks priekš ēdiena nosaukuma
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                // Teksta lauks priekš ēdiena apraksta
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(), //Aizņem pilnu kolonnas platumu
                // Skaitliskais lauks priekš cenas ar prefiksu €
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric() // Atļauts ievadīt tikai skaitliskās vērtības
                    ->prefix('€'),
                // Izvēles lauks kategorijai ar iespējām
                Forms\Components\Select::make('category')
                    ->required()
                    ->options([
                        'Main Course' => 'Main Course',
                        'Snacks' => 'Snacks',
                        'Desserts' => 'Desserts',
                        'Drinks' => 'Drinks',
                    ]),
                // Attēlu augšupielādes lauks
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('images')
                    ->columnSpanFull(),
            ]);
    }

//Konfigurē tabulu priekš ēdienkartes vienumu pārvaldības.
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolonna priekš ēdiena nosaukuma
                Tables\Columns\TextColumn::make('name')
                    ->searchable(), // Iespēja meklēt pēc šīs kolonnas
                // Kolonna priekš apraksta ar simbolu ierobežojumu
                Tables\Columns\TextColumn::make('description')
                    ->limit(50), //Parāda pirmos 50 simbolus
                // Kolonna priekš cenas ar valūtas formatējumu
                Tables\Columns\TextColumn::make('price')
                    ->money('EUR') //Valūtas formāts eiro
                    ->sortable(), // Iespēja kārtot pēc cenas
                //Kolonna priekš kategorijas
                Tables\Columns\TextColumn::make('category')
                    ->searchable(), //Iespeja meklet pec sis kollonas
                //Kollona priekš attēla parādīšanas
                Tables\Columns\ImageColumn::make('image'),
            ])
            ->filters([
                // Filtrs, lai atlasītu ierakstus pēc kategorijas
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Main Course' => 'Main Course',
                        'Snacks' => 'Snacks',
                        'Desserts' => 'Desserts',
                        'Drinks' => 'Drinks',
                    ]),
            ])
            ->actions([
                //Darbība lai rediģētu
                Tables\Actions\EditAction::make(),
                //Darbība lai dzēstu
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Masveida darbību grupēšana, ieskaitot dzēšanu
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    //Iegūst attiecības, kas saistītas ar resursu.
    public static function getRelations(): array
    {
        return [
            //Definē lapas, kas saistītas ar šo resursu.
        ];
    }

    public static function getPages(): array
    {
        return [
            // Lapa, kas parāda visu ierakstu sarakstu
            'index' => Pages\ListMenuItems::route('/'),
            // Lapa, lai izveidotu jaunu ierakstu
            'create' => Pages\CreateMenuItem::route('/create'),
            // Lapa, lai rediģētu konkrētu ierakstu
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}

