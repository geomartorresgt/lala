<?php

namespace App\Exports;

use App\Models\Local;
use App\Models\Mueble;
use App\Models\CategoriaMueble;
use Maatwebsite\Excel\Concerns\FromCollection;

class MueblesExport implements FromCollection
{

    private $local_id;

    function __construct(Local $local)
    {
        $this->local_id = $local->id;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $localId = $this->local_id;
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
}
