<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model {

    protected $table = 'clases';

    protected $fillable = [
        'nombre',
        'phylum_id',
        'creador_id'

    ];

    /**
     * Una clase PERTENECE a un phylum.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phylum()
    {
        return $this->belongsTo('App\Phylum');

    }

    /**
     * Una clase POSEE muchas subclases.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subclases()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Subclase');
    }

    /**
     * Una clase POSEE muchos ordenes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenes()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Orden');
    }

}
