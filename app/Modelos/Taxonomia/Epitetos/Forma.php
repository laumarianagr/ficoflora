<?php namespace App\Modelos\Taxonomia\Epitetos;

use Illuminate\Database\Eloquent\Model;

class Forma extends Model {

    protected $table = 'epitetos_formas';

    protected $fillable = [
        'nombre',
        'creador_id'

    ];


}
