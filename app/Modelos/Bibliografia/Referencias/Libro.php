<?php

namespace App\Modelos\Bibliografia\Referencias;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'referencias_libros';

    protected $fillable = [

        'autores',
        'fecha',
        'cita',
        'cita_html',
        'letra',
        'titulo',
        'edicion',
        'editorial',
        'lugar',
        'paginas',
        'capitulo',
        'editor',
        'intervalo',
        'isbn',
        'doi',
        'enlace',
        'archivo'
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
