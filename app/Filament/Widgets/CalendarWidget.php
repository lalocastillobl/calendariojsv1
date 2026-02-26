<?php

namespace App\Filament\Widgets;


use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;//seagrega
use App\Filament\Resources\Events\EventResource; //seagrega
use App\Models\Event; // se agrega 

use Illuminate\Database\Eloquent\Model;
use filament\Forms;

class CalendarWidget extends FullCalendarWidget // se agrega fullcalendarwidget
{
    public Model | string | null $model = Event::class;


    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('start_at', '>=', $fetchInfo['start'])
            ->where('end_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Event $event) => [
                    'id' => $event->id,
                    'title' => $event->title,
                    'color' => $event->color,
                    'start' => $event->start_at,
                    'end' => $event->end_at,
                    
                ]
            )
            ->toArray();
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
            ->required(),
            Forms\Components\ColorPicker::make('color')
            ->required(),
            
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('start_at')
                     ->required(),
                    Forms\Components\DateTimePicker::make('end_at')
                     ->required(),
                ]),
        ];
    }



}
