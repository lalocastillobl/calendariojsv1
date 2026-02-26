<?php

namespace App\Filament\Resources\Personas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PersonasExport;

class PersonasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('num_trabajador')->searchable(),

                TextColumn::make('anio')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('periodo')->searchable(),

                TextColumn::make('lunes_in')->time()->sortable(),
                TextColumn::make('lunes_out')->time()->sortable(),

                TextColumn::make('martes_in')->time()->sortable(),
                TextColumn::make('martes_out')->time()->sortable(),

                TextColumn::make('miercoles_in')->time()->sortable(),
                TextColumn::make('miercoles_out')->time()->sortable(),

                TextColumn::make('jueves_in')->time()->sortable(),
                TextColumn::make('jueves_out')->time()->sortable(),

                TextColumn::make('viernes_in')->time()->sortable(),
                TextColumn::make('viernes_out')->time()->sortable(),

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

            ->actions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                    BulkAction::make('export_excel')
                        ->label('Exportar Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(fn ($records) =>
                            Excel::download(
                                new PersonasExport($records),
                                'personas.xlsx'
                            )
                        ),

                    BulkAction::make('export_pdf')
                        ->label('Exportar PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->action(function ($records) {

                            $pdf = Pdf::loadView('pdf.personas', [
                                'personas' => $records
                            ]);

                            return response()->streamDownload(
                                fn () => print($pdf->output()),
                                'personas.pdf'
                            );
                        }),

                ]),
            ]);
    }
}
