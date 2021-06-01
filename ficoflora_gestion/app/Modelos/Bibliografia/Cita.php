<?php namespace App\Modelos\Bibliografia;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model {

    protected $table = 'citas';

    protected $fillable = [
        'autores',
        'fecha',
        'letra',
        'tipo',
        'referencia_id',
    ];

    /**
     * Obtiene las Especies ASOCIADAS a la Cita.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function especies()
    {
        return $this->belongsToMany('App\Modelos\Taxonomia\Especie', 'reportes')->withTimestamps();
    }


    /**
     * Obtiene los reportes ASOCIADOS a la cita.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reportes()
    {
        return $this->hasMany('App\Modelos\Reportes\Reporte');
    }





    public function scopeConFecha($query,$fecha)
    {
        return $query->where('fecha',$fecha);
    }

    public function scopeConLetra($query,$letra)
    {
        return $query->where('letra',$letra);
    }


}
