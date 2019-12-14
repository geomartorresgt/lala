<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaFrecuente extends Model
{
    protected $table = 'preguntas_frecuentes';
    protected $fillable = ['pregunta', 'respuesta'];
}
