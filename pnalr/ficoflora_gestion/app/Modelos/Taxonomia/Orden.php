<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model {

    protected $table = 'ordenes';

    protected $fillable = [
        'nombre',
        'clase_id',
        'subclase_id',
        'creador_id'

    ];

    /**
     * Un orden PERTENECE a una clase.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clase()
    {
        return $this->belongsTo('App\Modelos\Taxonomia\Clase');

    }

    /**
     * Un orden PERTENECE a una subclase.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subclase()
    {
        return $this->belongsTo('App\Modelos\Taxonomia\Subclase');

    }

    /**
     * Un orden POSEE muchas familias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familias()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Familia');
    }

}
