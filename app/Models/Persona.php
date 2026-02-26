<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'num_trabajador',
        'anio',
        'periodo',

        'lunes_in','lunes_out',
        'martes_in','martes_out',
        'miercoles_in','miercoles_out',
        'jueves_in','jueves_out',
        'viernes_in','viernes_out',
    ];
}
