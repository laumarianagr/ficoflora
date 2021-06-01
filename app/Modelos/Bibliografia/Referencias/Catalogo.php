<?php

namespace App\Modelos\Bibliografia\Referencias;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'referencias_catalogos';

    protected $fillable = [
        'autores',
        'fecha',
        'cita',
        'letra',
        'titulo',
        'nombre',
        'edicion',
        'editor_editorial',
        'lugar',
        'volumen',
        'numero',
        'paginas',
        'isbn',
        'doi',
        'archivo',
        'comentarios',
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