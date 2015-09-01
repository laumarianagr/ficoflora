<?php namespace App\Modelos\Taxonomia;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model {

    protected $table = 'autores';

    protected $fillable = [
        'nombre',
        'creador_id'
    ];

}
