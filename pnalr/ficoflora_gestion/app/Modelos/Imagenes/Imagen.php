<?php

namespace App\Modelos\Imagenes;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes_especies';

    protected $fillable = [
        'imagen',
        'especie_id',
        'tipo',
        'leyenda',

    ];

    public function scopeConTipo($query,$tipo)
    {
        return $query->where('tipo',$tipo);
    }
}
