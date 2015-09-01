<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model {

    protected $table = 'generos';

    protected $fillable = [
        'nombre',
        'familia_id',
        'creador_id'

    ];

    /**
     * Una genero PERTENECE a una familia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familia()
    {
        return $this->belongsTo('App\Modelos\Taxonomia\Familia');

    }

    /**
     * Una genero POSEE muchas especies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function especies()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Especie');
    }

}
