<?php

use App\PreguntaFrecuente;
use Illuminate\Database\Seeder;

class PreguntasFrecuentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preguntasFrecuentes = [
            [
                'pregunta' => '¿Pregunta número 1?',
                'respuesta' => 'Respuesta número 1',
            ],
            [
                'pregunta' => '¿Pregunta número 2?',
                'respuesta' => 'Respuesta número 2',
            ],
            [
                'pregunta' => '¿Pregunta número 3?',
                'respuesta' => 'Respuesta número 3',
            ],
            [
                'pregunta' => '¿Pregunta número 4?',
                'respuesta' => 'Respuesta número 4',
            ],
            [
                'pregunta' => '¿Pregunta número 5?',
                'respuesta' => 'Respuesta número 5',
            ],
            [
                'pregunta' => '¿Pregunta número 6?',
                'respuesta' => 'Respuesta número 6',
            ],
        ];

        PreguntaFrecuente::insert($preguntasFrecuentes);
    }
}
