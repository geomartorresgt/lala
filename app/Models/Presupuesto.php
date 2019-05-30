<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Presupuesto extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user', 'muebles'];
    protected $appends = ['subtotal', 'descuento_dinero', 'total' ];

    // appends
    public function getSubtotalAttribute()
    {
        return $this->getTotal();
    }

    public function getDescuentoDineroAttribute()
    {
        return $this->getDescuentoDinero();
    }

    public function getTotalAttribute()
    {
        return $this->subtotal - $this->descuento_dinero;
    }

    public function addMuebles($id_muebles)
    {
        if($this->muebles){
            $this->muebles()->delete();
        }

        $muebles = [];
        foreach ($id_muebles as $key => $mueble_id) {
            $muebles[] = new PresupuestoMueble(['mueble_id' => $mueble_id]);
        }

        $this->muebles()->saveMany($muebles);
    }

    public function generarReporte()
    {
        $pdf = \PDF::loadView('admin.presupuestos.reporte', ['presupuesto' => $this]);
        return $pdf->stream();
        return $pdf->download('presupuesto.pdf');
    }

    public function getTotal()
    {
        return $this->muebles->sum('mueble.precio');
    }

    public function getDescuentoDinero()
    {
        $total = $this->getTotal();
        if($total && $total > 0){
            return $this->getTotal() * $this->descuento / 100;
        }

        return 0;
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

    // relaciones
    public function muebles()
    {
        return $this->hasMany(PresupuestoMueble::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function capturas()
    {
        return $this->hasMany(CapturasPresupuesto::class);
    }


    // eventos
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->fecha = now();
            $model->user_id = auth()->user()->id;
        });
    }
    
}