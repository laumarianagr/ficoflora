<?php

use Illuminate\Database\Seeder;

class PerfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfiles')->insert(
            [
             'tipo' => 'Administrador',
             'descripcion'=> 'Usuario con la máxima permisología dentro de la aplicación, teniendo el control de la administración de los demás usuarios, así como de todas las configuraciones, funcionalidades y módulos que la aplicación permita.'
            ]
        );
        DB::table('perfiles')->insert(
            ['tipo' => 'Coordinador',
                'descripcion'=> 'Tiene todos los permisos de la aplicación, menos los de administración de usuarios y configuración de la aplicación.'
            ]
        );
        DB::table('perfiles')->insert(
            ['tipo' => 'Investigador Editor',
                'descripcion'=> 'Está asignado a los profesores del equipo de investigación del proyecto, podrán agregar registros y realizar modificaciones y eliminaciones de estos (solamente de aquellos registros de los cuales sea autor, es decir creados dentro de la aplicación por él mismo). También podrá aprobar la inclusión de registros enviados por investigadores invitados.'
            ]
        );
        DB::table('perfiles')->insert(
            ['tipo' => 'Investigador Invitado',
                'descripcion'=> 'Estos usuarios pueden realizar envíos de nuevos registros para ser incluidos en la aplicación, sin embargo, su aprobación queda a consideración del equipo de investigadores del proyecto. No pueden modificar ni eliminar ningún tipo de datos, así como tampoco pueden exportar información o tablas de la base de datos.'
            ]
        );
//        DB::table('perfiles')->insert(
//            ['tipo' => 'Personal Auxiliar',
//                'descripcion'=> 'Está asignado a pasantes, preparadores, auxiliares y/o estudiantes en trabajo de tesis, podrán agregar información complementaria para llenar las listas de opciones como localidades, nombres de clasificaciones taxonómicas, sinónimos, referencias, datos que son usados múltiples veces por los demás perfiles superiores para rellenar los formularios de registros. No pueden crear, modificar ni eliminar ningún tipo de registro, tampoco pueden realizar envíos de registros ni realizar exportación de información o tablas de la base de datos.'
//            ]
//        );
//        DB::table('perfiles')->insert(
//            ['tipo' => 'Visitante',
//                'descripcion'=> 'Pertenece a cualquier usuario, autenticado o no, que navegue dentro de la aplicación web, la única actividad que puede realizar es la de consulta.'
//            ]
//        );
    }
}
