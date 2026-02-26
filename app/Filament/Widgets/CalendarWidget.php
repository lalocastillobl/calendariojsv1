<?php

namespace App\Filament\Widgets;


use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;//seagrega
use App\Filament\Resources\Events\EventResource; //seagrega
use App\Models\Event; // se agrega 

use Illuminate\Database\Eloquent\Model;
use filament\Forms;

class CalendarWidget extends FullCalendarWidget // se agrega fullcalendarwidget
{
   
    public function config(): array
    {
        return [
            // 'initialView' define qué se ve al cargar
            'initialView' => 'timeGridWeek', // O 'dayGridWeek' para horas
            
            // Configura el encabezado para que el usuario pueda volver a la mensual
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
            ],
        ];
    }



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
                    'url' => EventResource::getUrl(name: 'edit', parameters: ['record' => $event]), // PARA EDITAR EVENTOS
                    'shouldOpenUrlInNewTab' => true
                ]
            )
            ->toArray();
    }

    
    

}
