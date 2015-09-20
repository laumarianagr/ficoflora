<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model {

    protected $table = 'autores';

    protected $fillable = [
        'nombre',
        'creador_id'
    ];

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
