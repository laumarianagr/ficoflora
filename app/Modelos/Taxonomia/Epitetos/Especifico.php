<?php namespace App\Modelos\Taxonomia\Epitetos;

use Illuminate\Database\Eloquent\Model;

class Especifico extends Model {

    protected $table = 'epitetos_especificos';

    protected $fillable = [
        'nombre',
        'creador_id'

    ];



}
