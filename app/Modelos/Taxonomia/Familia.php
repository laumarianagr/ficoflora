<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model {

    protected $table = 'familias';

    protected $fillable = [
        'nombre',
        'orden_id',
        'creador_id'

    ];


    /**
     * Una familia PERTENECE a un orden.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orden()
    {
        return $this->belongsTo('App\Modelos\Taxonomia\Orden');

    }

    /**
     * Una familia POSEE muchos generos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function generos()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Genero');
    }


}
