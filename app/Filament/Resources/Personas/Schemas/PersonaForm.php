<?php

namespace App\Filament\Resources\Personas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class PersonaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('num_trabajador')
                    ->required(),
                TextInput::make('anio')
                    ->required()
                    ->numeric(),
                TextInput::make('periodo')
                    ->required(),
                TimePicker::make('lunes_in'),
                TimePicker::make('lunes_out'),
                TimePicker::make('martes_in'),
                TimePicker::make('martes_out'),
                TimePicker::make('miercoles_in'),
                TimePicker::make('miercoles_out'),
                TimePicker::make('jueves_in'),
                TimePicker::make('jueves_out'),
                TimePicker::make('viernes_in'),
                TimePicker::make('viernes_out'),
            ]);
    }
}
