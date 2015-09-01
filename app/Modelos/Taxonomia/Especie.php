<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model {

    protected $table = 'especies';

    protected $fillable = [
        'genero_id',
        'especifico_id',
        'varietal_id',
        'forma_id',
        'autor_id',
        'descripcion',
        'creador_id',
        'catalogo'

    ];



    /**
     * Obtiene las Entidades ASOCIADAS a la Especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entidades()
    {
        return $this->belongsToMany('App\Modelos\Geografico\Entidad', 'especie_entidad')->withTimestamps();

    }

    /**
     * Obtiene las Localidades ASOCIADAS a la Especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function localidades()
    {
        return $this->belongsToMany('App\Modelos\Geografico\Localidad', 'especie_localidad')->withTimestamps();

    }

    /**
     * Obtiene los Lugares ASOCIADOS a la Especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lugares()
    {
        return $this->belongsToMany('App\Modelos\Geografico\Lugar', 'especie_lugar')->withTimestamps();

    }

    /**
     * Obtiene los Sitios ASOCIADOS a la Especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sitios()
    {
        return $this->belongsToMany('App\Modelos\Geografico\Sitio', 'especie_sitio')->withTimestamps();

    }



    /**
     * Obtiene los reportes ASOCIADOS a la especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reportes()
    {
        return $this->hasMany('App\Modelos\Bibliografia\Reporte');
    }



    /**
     * Una especie PERTENECE a un Usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Modelos\Cuentas\Usuario');

    }

    /**
     * Una especie PERTENECE a un genero.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genero()
    {
        return $this->belongsTo('App\Modelos\Taxonomia\Genero');

    }

    /**
     * Obtiene las citas ASOCIADAS a la especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function citas()
    {
        return $this->belongsToMany('App\Modelos\Bibliografia\Cita', 'reportes')->withTimestamps();
    }


    /**
     * Obtiene las citas ASOCIADAS a la especie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sinonimias()
    {
        return $this->belongsToMany('App\Modelos\Sinonimias\Sinonimia', 'sinonimias_especies')->withTimestamps();
    }



    /**
     * Busca en la BDD si hay VARIEDADES con un nombre determinado.
     *
     * @param $query
     */
    public function scopeConVarietal($query,$varietal_id)
    {
        return $query->where('varietal_id', $varietal_id);
    }

    /**
     * Busca en la BDD si hay FORMAS con un nombre determinado.
     *
     * @param $query
     */
    public function scopeConForma($query,$forma_id)
    {
        return $query->where('forma_id',$forma_id);
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


    public function scopeConEspecieId($query,$especie_id)
    {
        return $query->where('especie_id',$especie_id);
    }

    public function scopeConGeneroId($query,$genero_id)
    {
        return $query->where('genero_id',$genero_id);
    }



}
