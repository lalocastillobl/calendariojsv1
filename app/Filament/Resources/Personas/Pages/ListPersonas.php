<?php

namespace App\Filament\Resources\Personas\Pages;

use App\Filament\Resources\Personas\PersonaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonas extends ListRecords
{
    protected static string $resource = PersonaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => auth()->user()?->hasAnyRole(['admin','editor']))
        ];
    }
}
