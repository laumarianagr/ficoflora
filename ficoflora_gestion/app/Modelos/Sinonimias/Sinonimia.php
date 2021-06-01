<?php

namespace App\Modelos\Sinonimias;

use Illuminate\Database\Eloquent\Model;

class Sinonimia extends Model
{

    protected $table = 'sinonimias';

    protected $fillable = [
        'genero_id',
        'especifico_id',
        'varietal_id',
        'forma_id',
        'autor_id',
        'creador_id'
    ];



    /**
     * Obtiene las citas ASOCIADAS a la especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function especies()
    {
        return $this->belongsToMany('App\Modelos\Taxonomia\Especie', 'sinonimias_especies')->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Relacion especie-referencia-sinonimia
     */
    public function registros()
    {
        return $this->belongsToMany('App\Modelos\Catalogo\Registro', 'registro_sinonimia')->withTimestamps();
    }


    /**
     * Busca en la BDD si hay un ESPECIE con un id determinado.
     *
     * @param $query
     */
    public function scopeConId($query,$id)
    {
        return $query->where('id',$id);
    }

    public function scopeConGeneroId($query,$genero_id)
    {
        return $query->where('genero_id',$genero_id);
    }

    public function scopeConEspecificoId($query,$especifico_id)
    {
        return $query->where('especifico_id',$especifico_id);
    }

    /**
     * Busca en la BDD si hay VARIEDADES con un nombre determinado.
     *
     * @param $query
     */
    public function scopeConVarietalId($query,$varietal_id)
    {
        return $query->where('varietal_id', $varietal_id);
    }

    /**
     * Busca en la BDD si hay FORMAS con un nombre determinado.
     *
     * @param $query
     */
    public function scopeConFormaId($query,$forma_id)
    {
        return $query->where('forma_id',$forma_id);
    }

    /**
     * Busca en la BDD si hay FORMAS con un nombre determinado.
     *
     * @param $query
     */
    public function scopeConAutorId($query,$autor_id)
    {
        return $query->where('autor_id',$autor_id);
    }



}
