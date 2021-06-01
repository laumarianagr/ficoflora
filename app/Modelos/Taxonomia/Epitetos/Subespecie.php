<?php namespace App\Modelos\Taxonomia\Epitetos;

use Illuminate\Database\Eloquent\Model;

class Subespecie extends Model {

    protected $table = 'epitetos_subespecies';

    protected $fillable = [
        'nombre',
        'creador_id'

    ];
}
