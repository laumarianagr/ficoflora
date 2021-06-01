<?php

namespace App\Modelos\Bibliografia\Referencias;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $table = 'referencias_trabajos';

    protected $fillable = [
        'tipo',
        'autores',
        'fecha',
        'cita',
//        'cita_cita',
        'letra',
        'titulo',
        'institucion',
        'lugar',
        'paginas',
        'enlace',
        'archivo',
        'comentarios',
        'creador_id',


    ];


    public function scopeConFecha($query,$fecha)
    {
        return $query->where('fecha',$fecha);
    }

    public function scopeConLetra($query,$letra)
    {
        return $query->where('letra',$letra);
    }
}

