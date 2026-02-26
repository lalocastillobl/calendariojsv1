<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\ColorPicker;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('title')
                ->label('Título')
                ->required(),

            ColorPicker::make('color')
                ->label('Color'),

            DateTimePicker::make('start_at')
                ->label('Inicio')
                ->required(),

            DateTimePicker::make('end_at')
                ->label('Fin')
                ->required(),

        ]);
    }
}