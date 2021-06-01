<?php

namespace App\Modelos\Bibliografia\Referencias;

use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    protected $table = 'referencias_enlaces';

    protected $fillable = [
        'autores',
        'fecha',
        'cita',
        'letra',
        'nombre',
        'titulo',
        'institucion',
        'lugar',
        'enlace',
        'dia',
        'mes',
        'ano',
        'creador_id'
    ];


    public function scopeConFecha($query,$fecha)
    {
        return $query->where('fecha',$fecha);
    }
}

