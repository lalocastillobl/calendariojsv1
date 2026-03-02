<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;//seagrega
use App\Models\Event; // se agrega 
use Illuminate\Database\Eloquent\Model;
use Filament\Forms; // corregido namespace
use Filament\Actions\Action; // agregado para acciones modal

use Filament\Forms\Components\TextInput; // 
use Filament\Forms\Components\ColorPicker; // agregado
use Filament\Forms\Components\DateTimePicker; // agregado


class CalendarWidget extends FullCalendarWidget // se agrega fullcalendarwidget
{
    public Model | string | null $model = Event::class; // modelo usado por el calendario

    protected bool $selectable = true; // permite seleccionar rango
    protected bool $editable = true; // permite mover eventos



    public function config(): array
    {
        return [
            // 'initialView' define qué se ve al cargar
            'initialView' => 'timeGridWeek', // O 'dayGridWeek' para horas
            
            'selectable' => true, //  ESTO FALTABA                    1  
            'selectMirror' => true, // ← muestra preview al arrastrar  2
            'selectOverlap' => false, // opcional evita superposición  3


            // Configura el encabezado para que el usuario pueda volver a la mensual
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
            ],
        ];
    } //CONFIG 



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
                    // quitamos url para evitar redirección y permitir modal
                ]
            )
            ->toArray();
    } //FETCH EVENTS



    public function getFormSchema(): array // FORMULARIO DEL MODAL
    {
        return [
            TextInput::make('title')
                ->required(),

            ColorPicker::make('color')
                ->required(),

            DateTimePicker::make('start_at')
                ->required(),

            DateTimePicker::make('end_at')
                ->required(),
        ];
    }



    protected function onSelect(array $info): void // CAPTURAR EL RANGO SELECCIONADO
    {
        $this->mountAction('create', [
            'start_at' => $info['start'],
            'end_at' => $info['end'],
        ]);
    }  // ONE SELECT
    


    protected function onDateClick(array $info): void // CLICK SIMPLE SIN ARRASTRAR
    {
        $this->mountAction('create', [
            'start_at' => $info['date'],
            'end_at' => $info['date'],
        ]);
    } //ONDATECLICK



    protected function getActions(): array // DEFINIR EL MODAL DE CREACION
    {
        return [
            Action::make('create')
                ->label('New event')
                ->form($this->getFormSchema())
                ->action(function (array $data) {
                    Event::create($data); // guarda evento
                    $this->dispatch('refresh'); // refresca calendario
                }),
        ];
    } //GET MODAL ACTIONS


}