<?php namespace App\Modelos\Geografico;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model {

    protected $table = 'localidades';


    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'entidad_id',
        'creador_id',

    ];


/**
 * RELACIONES
 * -------------------------------------------------------------
 */

    /**
     * Una localidad PERTENECE a una entidad.
     *
     */
    public function entidad()
    {
        return $this->belongsTo('App\Modelos\Geografico\Entidad');
    }

    /**
     * Una Localidad POSEE muchos Lugares.
     *
     */
    public function lugares()
    {
        return $this->hasMany('App\Modelos\Geografico\Lugar');
    }

    /**
     * Obtiene las Especies ASOCIADAS a la Localidad.
     *
     */
    public function especies()
    {
        return $this->belongsToMany('App\Modelos\Taxonomia\Especie', 'especie_localidad');
    }

    /**
     * Obtiene los Reportes ASOCIADOS a la Localidad.
     *
     */
    public function reportes()
    {
        return $this->belongsToMany('App\Modelos\Reportes\Reporte', 'reporte_localidad')->withTimestamps();
    }



/**
 * ESCOPE
 * ------------------------------------------------------------------
 */

    /**
     * Busca en la BDD si hay una localidad con un nombre proporcionado.
     *
     */
    public function scopeConNombre($query,$nombre)
    {
        return $query->where('nombre', $nombre);
    }

    /**
     * Busca localidades que sean de una entidad con un ID determinado.
     *
     */
    public function scopeConEntidadId($query, $entidad_id)
    {
        return $query->where('entidad_id', $entidad_id);
    }

    public function scopeConId($query,$id)
    {
        return $query->where('id',$id);
    }



}
