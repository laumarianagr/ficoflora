<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'usuario' => 'maria.pinzon',
            'password' => bcrypt('123456'),
            'email' => 'admin@email.com',
            'nombre' => 'María',
            'apellido' => 'Pinzón',
            'perfil_id' => '1',
            'descripcion' => 'Estudiante de la Escuela de Computación de la Faculta de Ciencias de la Universidad Central de Venezuela.'
        ]);
        DB::table('usuarios')->insert([
            'usuario' => 'santiago.gomez',
            'password' => bcrypt('123456'),
            'email' => 'coordinador@email.com',
            'nombre' => 'Santiago',
            'apellido' => 'Gómez',
            'perfil_id' => '2',
            'descripcion' => 'Profesor de la Escuela de Biología y Coordinador Administrativo de la Facultad de Ciencias,  Universidad Central de Venezuela.'
        ]);

        DB::table('usuarios')->insert([
            'usuario' => 'yusneyi.carballo',
            'password' => bcrypt('123456'),
            'email' => 'yusneyi@email.com',
            'nombre' => 'Yusneyi',
            'apellido' => 'Carballo Barrera',
            'perfil_id' => '2',
            'descripcion' => 'Profesora de la Escuela de Computación y Coordinadora del Centro de Enseñanza Asistida por Computador (CENEAC) de la Facultad de Ciencias, Universidad Central de Venezuela.'
        ]);

        DB::table('usuarios')->insert([
            'usuario' => 'juan.perez',
            'password' => bcrypt('123456'),
            'email' => 'editor@email.com',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'perfil_id' => '3',

        ]);
        DB::table('usuarios')->insert([
            'usuario' => 'patricia.Ramos',
            'password' => bcrypt('123456'),
            'email' => 'patricia@email.com',
            'nombre' => 'Patricia',
            'apellido' => 'Ramos',
            'perfil_id' => '3',

        ]);
        DB::table('usuarios')->insert([
            'usuario' => 'ana.lopez',
            'password' => bcrypt('123456'),
            'email' => 'invitado@email.com',
            'nombre' => 'Ana',
            'apellido' => 'López',
            'perfil_id' => '4',

        ]);
        DB::table('usuarios')->insert([
            'usuario' => 'erika.torres',
            'password' => bcrypt('123456'),
            'email' => 'erika@email.com',
            'nombre' => 'Erika',
            'apellido' => 'Torres',
            'perfil_id' => '4',

        ]);
        DB::table('usuarios')->insert([
            'usuario' => 'nuevo.torres',
            'password' => bcrypt('2015f1c0fl0r4'),
            'email' => 'nuevo@email.com',
            'nombre' => 'Neuvo',
            'apellido' => 'Torres',
            'perfil_id' => '4',

        ]);
    }
}
