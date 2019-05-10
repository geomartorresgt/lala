<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Presupuesto extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user'];

    public function muebles()
    {
        return $this->hasMany(PresupuestoMueble::class);;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addMuebles($id_muebles)
    {
        $this->muebles()->detach();
        $this->muebles()->attach( $id_muebles );
    }

    // mutatos 
    public function setFechaAttribute($value): void
    {
        $this->attributes['fecha'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getFechaAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}