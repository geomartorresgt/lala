<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaMueble extends Model
{
    protected $guarded = ['id'];
    protected $table = 'categorias_muebles';

    public function muebles(){
        return $this->hasMany(Mueble::class);
    }

    
}