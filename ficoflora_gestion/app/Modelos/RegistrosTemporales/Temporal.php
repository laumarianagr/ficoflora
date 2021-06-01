<?php

namespace App\Modelos\RegistrosTemporales;

use Illuminate\Database\Eloquent\Model;

class Temporal extends Model
{
    protected $table = 'temporales';

    protected $fillable = [
        'autoridad',
        'subespecie',
        'forma',
        'varietal',
        'especifico',
        'genero',
        'familia',
        'orden',
        'subclase',
        'clase',
        'phylum',
        'referencia',
        'referencia_tipo',
        'sinonimias',
        'ubicacion',
        'creador_id'
    ];
}