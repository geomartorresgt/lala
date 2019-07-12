<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Presupuesto extends Model
{
    protected $guarded = ['id'];
    protected $with = ['user', 'muebles'];
    protected $appends = ['subtotal', 'descuento_dinero', 'monto_iva', 'monto_iva_sin_descuento', 'total', 'total_sin_descuento' ];

    // appends
    public function getSubtotalAttribute()
    {
        return $this->getTotal();
    }

    public function getDescuentoDineroAttribute()
    {
        return $this->getDescuentoDinero();
    }

    public function getMontoIvaAttribute()
    {
        $iva = Config::getIva();
        $subTotal = $this->subtotal - $this->descuento_dinero;
        return $subTotal * ( $iva / 100 );
    }

    public function getMontoIvaSinDescuentoAttribute()
    {
        $iva = Config::getIva();
        return $this->subtotal * ( $iva / 100 );
    }

    public function getTotalSinDescuentoAttribute()
    {
        return $this->subtotal + $this->monto_iva_sin_descuento ;
    }

    // methods
    public function getTotalAttribute()
    {
        return $this->subtotal - $this->descuento_dinero + $this->monto_iva ;
    }

    public function tieneDescuento()
    {
        return $this->descuento > 0;
    }

    public function addMuebles($id_muebles)
    {
        $local_id = auth()->user()->local_id;
        echo "local_id: $local_id \n";
        $localMuebles = LocalMueble::whereLocalId( $local_id )->get();

        if($this->muebles){
            $this->muebles()->delete();
        }

        $muebles = [];
        foreach ($id_muebles as $key => $mueble_id) {
            $localMueble = $localMuebles->first( function($item) use($mueble_id) {  return $item->mueble_id == $mueble_id ; } );
            $muebles[] = new PresupuestoMueble([
                                        'mueble_id' => $mueble_id,
                                        'mueble_local_id' => $localMueble->id,
                                        'precio' => $localMueble->precio,
                                    ]);
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
        return ceil( $this->muebles->sum('localMueble.precio') );
    }

    public function getDescuentoDinero()
    {
        $total = $this->getTotal();
        if($total && $total > 0){
            return $this->getTotal() * $this->descuento / 100;
        }

        return 0;
    }

    // 
    public function setFechaAttribute($value): void
    {
        $this->attributes['fecha'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getFechaAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public static function filter(array $options = [])
    {
        if ( sizeof($options) >= 0 ) {
            $presupuesto = Presupuesto::with('local');
            $fechaInicio = array_key_exists('fecha_inicio', $options) && $options['fecha_inicio'] != null ? Carbon::createFromFormat('d/m/Y', $options['fecha_inicio'])->format('Y-m-d')  :null;
            $fechaFin = array_key_exists('fecha_fin', $options) && $options['fecha_fin'] != null ? Carbon::createFromFormat('d/m/Y', $options['fecha_fin'])->format('Y-m-d') :null;
            $localId = array_key_exists('local_id', $options)?  $options['local_id'] :null;
            
            if (!$localId && !$fechaInicio) {
                return $presupuesto->get();
            }

            if ($fechaInicio) {
                $presupuesto = Presupuesto::entreFechas($fechaInicio, $fechaFin);
            }

            if ($localId && $presupuesto != null) {
                $presupuesto = $presupuesto->whereLocalId($localId);
            } else if($localId) {
                $presupuesto = Presupuesto::whereLocalId($localId);
            }

            return $presupuesto->get();
        }

        return Presupuesto::all();
    }

    public function scopeEntreFechas($query ,$fechaInicio, $fechaFin = null)
    {
        if ($fechaFin == null)
            $fechaFin = $fechaInicio;
        return $query->whereBetween('fecha', [$fechaInicio, $fechaFin] );
    }

    // relationships
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

    public function local()
    {
        return $this->belongsTo(Local::class);
    }


    // events
    public static function boot()
    {
        parent::boot();
        
        self::creating(function($presupuesto){
            $user = auth()->user();
            $presupuesto->fecha = now();
            $presupuesto->user_id = $user->id;
            $presupuesto->local_id = $user->local_id;
            $presupuesto->descuento = $presupuesto->descuento? $presupuesto->descuento : 0;
        });

        self::deleting(function($presupuesto){
            $presupuesto->muebles()->delete();
            $presupuesto->capturas()->delete();
        });

        
    }
    
}