<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalMueble extends Model
{
    protected $guarded = ['id'];
    protected $table = 'muebles_local';

    public static function add_muebles($muebles = [])
    {
        $local_id = auth()->user()->local_id;
        $localMuebles = collect($muebles);
        foreach ($localMuebles as $mueble_id => $precio){
            $muebleLocal = LocalMueble::where('local_id',$local_id)->where('mueble_id',$mueble_id)->first();
             if($muebleLocal != null){
                 $muebleLocal->precio = $precio;
                 $muebleLocal->save();
             }else{
                $muebleLocal = new LocalMueble();
                $muebleLocal->local_id = $local_id;
                $muebleLocal->mueble_id = $mueble_id;
                $muebleLocal->precio = $precio;
                $muebleLocal->save();
             }
            
        }
    
     
       /* self::whereLocalId($local_id)->delete();
        $localMuebles = collect($muebles)->reject(function($monto){
            $monto = floatval($monto);
            return !$monto;
        })->map(function($monto, $id) use ($local_id){
            return [
                'local_id' => $local_id,
                'mueble_id' => $id,
                'precio' => $monto,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });*/

      
        return true;
    }

    public static function exportMueblesLocal($local_id)
    {
        $localId = $local_id;
        $categoriasMuebles = CategoriaMueble::with('muebles')
                                            ->with(['muebles.localMuebles' => function($q) use ( $localId ) { 
                                                $q->where('local_id', $localId);
                                            }])
                                            ->get()
                                            ->reject(function($categoria){ 
                                                return !$categoria->muebles->count();
                                            });
        $array = collect([]);
        foreach ($categoriasMuebles as $categoria){

            foreach ($categoria->muebles as $mueble) {
                $precio = 0;
                if (optional($mueble->localMuebles->first()) ) {
                    $precio = optional($mueble->localMuebles->first())->precio == null? 0: optional($mueble->localMuebles->first())->precio;
                }
                $array->push([
                    $mueble->id,
                    $mueble->codigo,
                    $mueble->nombre,
                    $mueble->dimensiones,
                    $categoria->nombre,
                    $precio.''
                ]);
            }
        }
        return $array; 
    }

    // relationship
    public function mueble()
    {
        return $this->belongsTo(Mueble::class);
    }

    public function presupuestoMueble()
    {
        return $this->hasMany(PresupuestoMueble::class, 'mueble_local_id', 'id');
    }
    
}