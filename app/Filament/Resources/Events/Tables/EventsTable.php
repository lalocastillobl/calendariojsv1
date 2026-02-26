<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
    TextColumn::make('title')
        ->label('Título')
        ->searchable()
        ->sortable(),

    TextColumn::make('color')
        ->label('Color'),

    TextColumn::make('start_at')
        ->label('Inicio')
        ->dateTime()
        ->sortable(),

    TextColumn::make('end_at')
        ->label('Fin')
        ->dateTime()
        ->sortable(),

    TextColumn::make('created_at')
        ->dateTime()
        ->sortable()
        ->toggleable(isToggledHiddenByDefault: true),

    TextColumn::make('updated_at')
        ->dateTime()
        ->sortable()
        ->toggleable(isToggledHiddenByDefault: true),
])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
