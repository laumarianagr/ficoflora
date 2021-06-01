<?php

namespace App\Modelos\Cuentas;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

    protected $table = 'perfiles';


    protected $fillable = [
        'tipo',
    ];

    /**
     * Un Perfil POSEE muchos Usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Modelos\Cuentas\Usuario');
    }
}
