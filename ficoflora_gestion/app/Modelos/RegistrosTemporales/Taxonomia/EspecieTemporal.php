<?php

namespace App\Modelos\RegistrosTemporales\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class EspecieTemporal extends Model
{
    protected $table = 'especies_temporales';

    protected $fillable = [
        'genero',
        'especifico',
        'varietal',
        'forma',
        'subespecie',
        'autor',
        'descripcion',
        'creador_id',
        'familia',
        'orden',
        'sublcase',
        'clase',
        'phylum',
    ];
}