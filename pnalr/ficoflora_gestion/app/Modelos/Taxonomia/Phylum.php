<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Phylum extends Model {

    protected $table = 'phylums';

    protected $fillable = [
        'nombre',
        'nombre_comun_esp',
        'nombre_comun_eng',
        'creador_id'

    ];

    /**
     * Un Phylum POSEE muchas clases.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clases()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Clase');
    }


}
