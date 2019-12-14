<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = ['banner', 'titulo', 'descripcion', 'fecha'];

    // mutators
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getFechaAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getBannerAttribute($value)
    {
        if (!$this->exists) return '';

        if ($value == null) {
            return url("web/images/700x400.png");
        }else{
        	return url("/storage/img/eventos").'/'.$value;
           return url("").$value;
 
        }

        return $value;
    }
}
