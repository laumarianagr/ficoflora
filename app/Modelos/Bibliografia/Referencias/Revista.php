<?php

namespace App\Modelos\Bibliografia\Referencias;

use Illuminate\Database\Eloquent\Model;

class Revista extends Model
{
    protected $table = 'referencias_revistas';

    protected $fillable = [
        'autores',
        'fecha',
        'cita',
//        'cita_html',
        'letra',
        'titulo',
        'nombre',
        'volumen',
        'numero',
        'intervalo',
        'isbn',
        'issn',
        'doi',
        'enlace',
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
