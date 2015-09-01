<?php namespace App\Modelos\Geografico;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model {


    protected $table = 'entidades';

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'capital'
    ];

/**
 * RELACIONES
 * -------------------------------------------------------------
 */

    /**
     * Una Entidad POSEE muchas Localidades.
     *
     */
    public function localidades()
    {
        return $this->hasMany('App\Modelos\Geografico\Localidad');
    }

    /**
     * Obtiene las Especies ASOCIADAS a la Entidad.
     *
     */
    public function especies()
    {
        return $this->belongsToMany('App\Modelos\Taxonomia\Especie', 'especie_entidad')->withTimestamps();
    }





/**
 * ESCOPE
 * ------------------------------------------------------------------
 */

    public function scopeConId($query,$id)
    {
        return $query->where('id',$id);
    }


}
