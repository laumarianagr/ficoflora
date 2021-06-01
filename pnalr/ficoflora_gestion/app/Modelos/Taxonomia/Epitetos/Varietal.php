<?php namespace App\Modelos\Taxonomia\Epitetos;

use Illuminate\Database\Eloquent\Model;

class Varietal extends Model {

    protected $table = 'epitetos_varietales';

    protected $fillable = [
        'nombre',
        'creador_id'

    ];
    public function especies()
    {
        return $this->hasMany('App\Modelos\Taxonomia\Especie');
    }



}
