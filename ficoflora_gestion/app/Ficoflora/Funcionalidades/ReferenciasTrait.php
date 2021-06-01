<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 31/07/2015
 * Time: 21:04
 */

namespace App\Ficoflora\Funcionalidades;



trait ReferenciasTrait {

    public function getLetra($letra)
    {
        if($letra != null){
            $alfabeto = range('a', 'z');
            $indice = array_search($letra, $alfabeto);

            return $alfabeto[$indice+1];
        }else{
            return 'a';
        }

    }

    public function getCita($autores, $cantidad)
    {
        $autores = trim($autores, " ");
        //ejem 2 autores: Guilarte, S. & S. Meléndez
        $autor_1 = $autor_2 = true;

        $autor_1= strstr($autores, ',', true); //Guillarte


        switch($cantidad){

            case 1:// Guillarte
                $cita = $autor_1;
                $cita_html = $cita;
                break;

            case 2://Guillarte & Meléndez
                
                $autor_2= substr(strrchr($autores,' '),1);//Meléndez
                $cita = $autor_1.' & '.$autor_2;
                $cita_html = $cita;

                break;

            case 3: //Gullarte et al

                $cita = $autor_1.' et al.';
                $cita_html = $autor_1.' <em>et al.</em>';

                break;
        }

        //errores en el formato
        if(($autor_1 == false) || ($autor_2 == false)){
            $cita = false;
        }
//        dd($autor_1, $autor_2, $cita, $autor_1 == false);

        return compact('cita', 'cita_html');
    }


    public function getCitaArchivo($cita)
    {
        $autores = $cita_html = $fecha = $letra = $error = null;
        $ultima = strrpos($cita,',');//ultima coma ejem: "Bello, Pérez & Yang, 1995a"
//        dd($cita, $ultima);
        if($ultima != false) {

            $autores = substr($cita, 0, $ultima); // parte de la cita sin fecha ni (,)

            $fecha = substr($cita, $ultima + 1, strlen($cita)); // 1995a
            $fecha = trim($fecha, " ");

            $letra = null;

            if (strlen($fecha) > 4)//la fecha tiene letra ejem: "1995a"
            {
                $letra = substr($fecha, -1);
                $fecha = substr($fecha, 0, 4);
            }

            if (strstr($autores, 'et al')) {
                $cita_html = strstr($autores, ' ', true) . ' <em>et al.</em>';
            } else {
                $cita_html = $autores;
            }
//        dd($this->cita, $this->cita_html, $this->fecha, $this->letra);
        }else{
            $error = true;
        }
//        dd($autores, $cita_html, $fecha, $letra, $error);


        return compact('autores', 'cita_html', 'fecha', 'letra', 'error');

    }

}