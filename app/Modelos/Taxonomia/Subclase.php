<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Subclase extends Model {

    protected $table = 'subclases';

    protected $fillable = [
        'nombre',
        'clase_id',
        'creador_id'

    ];

    /**
     * Una subclase PERTENECE a una clase.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clase()
    {
        return $this->belongsTo('App\Modelos\Taxonomia\Clase');

    }


    /**
     * Una subclase POSEE muchos ordenes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenes()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Orden');
    }



}
