<?php namespace App\Modelos\Geografico;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model {

    protected $table = 'sitios';

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'lugar_id',
    ];


/**
 * RELACIONES
 * -------------------------------------------------------------
 */

    /**
     * Un Sitio PERTENECE a una localidad
     *
     */
    public function lugar()
    {
        return $this->belongsTo('App\Modelos\Geografico\Lugar');
    }

    /**
     * Obtiene las Especies ASOCIADAS a el Sitio.
     *
     */
    public function especies()
    {
        return $this->belongsToMany('App\Modelos\Taxonomia\Especie', 'especie_sitio');
    }

    /**
     * Obtiene los Reportes ASOCIADOS al Sitio.
     *
     */
    public function reportes()
    {
        return $this->belongsToMany('App\Modelos\Reportes\Reporte', 'reporte_sitio')->withTimestamps();
    }



/**
 * ESCOPE
 * ------------------------------------------------------------------
 */

    public function scopeConNombre($query,$nombre)
    {
        return $query->where('nombre', $nombre);
    }

    public function scopeConLugarId($query, $lugar_id)
    {
        return $query->where('lugar_id', $lugar_id);
    }

    public function scopeConId($query, $id)
    {
        return $query->where('id', $id);
    }



}
