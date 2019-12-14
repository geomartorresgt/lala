<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'clave'];

    public function publicaciones()
    {
        return $this->belongsToMany(Publicacion::class, 'categorias_publicaciones');
    }

}
