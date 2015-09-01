<?php namespace App\Modelos\Geografico;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model {

    protected $table = 'lugares';

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'localidad_id',
    ];

/**
 * RELACIONES
 * -------------------------------------------------------------
 */

    /**
     * Un Lugar PERTENCE a una Localidad
     *
     */
    public function localidad()
    {
        return $this->belongsTo('App\Modelos\Geografico\Localidad');
    }

    /**
     * Un Lugar POSEE muchos Sitios
     *
     */
    public function sitios()
    {
        return $this->hasMany('App\Modelos\Geografico\Sitio');
    }

    /**
     * Obtiene las Especies ASOCIADAS a el Lugar.
     *
     */
    public function especies()
    {
        return $this->belongsToMany('App\Modelos\Taxonomia\Especie', 'especie_lugar');
    }


    /**
     * Obtiene los Reportes ASOCIADOS a el Lugar.
     *
     */
    public function reportes()
    {
        return $this->belongsToMany('App\Modelos\Reportes\Reporte', 'reporte_lugar')->withTimestamps();
    }


/**
 * ESCOPE
 * ------------------------------------------------------------------
 */

    public function scopeConNombre($query,$nombre)
    {
        return $query->where('nombre', $nombre);
    }

    public function scopeConLocalidadId($query, $localidad_id)
    {
        return $query->where('localidad_id', $localidad_id);
    }

    public function scopeConId($query, $id)
    {
        return $query->where('id', $id);
    }



}
