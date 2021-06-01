<?php

namespace App\Ficoflora\Cuentas;

use App\Modelos\Cuentas\Perfil;

trait checkPerfil
{
    /**
     * Retorna si un usuarios es administrador
     *
     * @return bool
     */
    public function admin()
    {
//        $admin = Perfil::where('tipo', 'Administrador')->first();
//        return $this->perfil_id == $admin->id;

        return $this->perfil_id == 1;
    }


    /**
     * Retorna si un usuarios es coordinador
     *
     * @return bool
     */
    public function coordinador()
    {
//        $coordinador = Perfil::where('tipo', 'Coordinador')->first();
//        return $this->perfil_id == $coordinador->id;
        return $this->perfil_id == 2;

    }


    /**
     * Retorna si un usuarios es investigador Editor
     *
     * @return bool
     */
    public function invEditor()
    {
//        $inv_editor = Perfil::where('tipo', 'Investigador Editor')->first();
//        return $this->perfil_id == $inv_editor->id;

        return $this->perfil_id == 3;
    }


    /**
     * Retorna si un usuarios es investigador invitado
     *
     * @return bool
     */
    public function invInvitado()
    {
//        $inv_invitado = Perfil::where('tipo', 'Investigador Invitado')->first();
//        return $this->perfil_id == $inv_invitado->id;

        return $this->perfil_id == 4;
    }


    /**
     * Retorna si un usuarios es investigador Editor
     *
     * @return bool
     */
    public function auxiliar()
    {
//        $auxiliar = Perfil::where('tipo', 'Personal Auxiliar')->first();
//        return $this->perfil_id == $auxiliar->id;

        return $this->perfil_id == 5;
    }

    /**
     * Retorna si un usuarios es Visitante
     *
     * @return bool
     */
    public function visitante()
    {
//        $auxiliar = Perfil::where('tipo', 'Visitante')->first();
//        return $this->perfil_id == $auxiliar->id;

        return $this->perfil_id == 6;
    }


    public function nivelPerfil()
    {
        return $this->perfil_id;

//        if($this->admin()){
//            return 1;
//        }
//        if($this->coordinador()){
//            return 2;
//        }
//        if($this->invEditor()){
//            return 3;
//        }
//        if($this->invInvitado()){
//            return 4;
//        }
    }

}
