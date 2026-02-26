<?php

namespace App\Filament\Resources\Personas;

use App\Filament\Resources\Personas\Pages\CreatePersona;
use App\Filament\Resources\Personas\Pages\EditPersona;
use App\Filament\Resources\Personas\Pages\ListPersonas;
use App\Filament\Resources\Personas\Schemas\PersonaForm;
use App\Filament\Resources\Personas\Tables\PersonasTable;
use App\Models\Persona;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;



class PersonaResource extends Resource
{
    protected static ?string $model = Persona::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'num_trabajador';

    public static function form(Schema $schema): Schema
    {
        return PersonaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPersonas::route('/'),
            'create' => CreatePersona::route('/create'),
            'edit' => EditPersona::route('/{record}/edit'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | PERMISOS POR ROLES
    |--------------------------------------------------------------------------
    */

    // Ver lista
    public static function canViewAny(): bool
    {
        return auth()->check();
    }

    // Crear
    public static function canCreate(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'editor']);
    }

    // Editar
    public static function canEdit($record): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'editor']);
    }

    // Borrar individual
    public static function canDelete($record): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    // Borrar masivo
    public static function canDeleteAny(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    // Mostrar en menú lateral
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check();
    }
}
