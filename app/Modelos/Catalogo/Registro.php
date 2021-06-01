<?php

namespace App\Modelos\Catalogo;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';

    protected $fillable = [
        'especie_id',
        'referencia_id',
        'tipo_referencia',
        'creador_id',
        'comentario'
    ];


    /**
     * Obtiene las citas ASOCIADAS a la especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function sinonimias()
    {
        return $this->belongsToMany('App\Modelos\Sinonimias\Sinonimia', 'registro_ubicacion_sinonimia')->withTimestamps();
    }


    /**
     * Obtiene las citas ASOCIADAS a la especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ubicaciones()
    {
        return $this->belongsToMany('App\Modelos\Geografico\Ubicacion', 'registro_ubicacion_sinonimia')->withTimestamps();
    }


    public function scopeConReferencia($query,$referencia_id)
    {
        return $query->where('referencia_id',$referencia_id);
    }

    public function scopeConTipo($query,$tipo_referencia)
    {
        return $query->where('tipo_referencia',$tipo_referencia);
    }
}
