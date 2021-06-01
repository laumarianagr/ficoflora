<?php

namespace App\Modelos\Geografico;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{

    protected $table = 'ubicaciones';

    protected $fillable = [
        'entidad_id',
        'localidad_id',
        'lugar_id',
        'sitio_id',
        'latitud',
        'longitud'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Relacion Especie-Referencia-Ubicación
     */
    public function registros()
    {
        return $this->belongsToMany('App\Modelos\Catalogo\Registro', 'registro_ubicacion')->withTimestamps();
    }




    /**
     * ESCOPE
     * ------------------------------------------------------------------
     */

    public function scopeConLocalidad($query,$localidad_id)
    {
        return $query->where('localidad_id',$localidad_id);
    }

    public function scopeConLugar($query,$lugar_id)
    {
        return $query->where('lugar_id',$lugar_id);
    }

    public function scopeConSitio($query,$sitio_id)
    {
        return $query->where('sitio_id',$sitio_id);
    }

    public function scopeConId($query,$id)
    {
        return $query->where('id',$id);
    }



}
