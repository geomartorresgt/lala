<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configuraciones';

    private static function getConfiguracion ($clave){
		return Config::where('clave', $clave)->first();
    }
    
    public static function getIva()
    {
        $config = self::getConfiguracion('iva');
        return (float) $config->valor;
    }
}
