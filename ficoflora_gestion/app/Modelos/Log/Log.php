<?php

namespace App\Modelos\Log;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'actividad',
        'usuario',
        'elemento',
        'id_elem',
        'ruta',
        'proceso',
        'anterior',
        'nuevo'
    ];

}
