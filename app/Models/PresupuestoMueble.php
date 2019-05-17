<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PresupuestoMueble extends Model
{
    protected $guarded = ['id'];
    protected $table = 'muebles_presupuesto';
    protected $with = ['mueble', 'presupuesto'];

    public function mueble()
    {
        return $this->belongsTo(Mueble::class);
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
    }

    // eventos
    public static function boot()
    {
        parent::boot();

        // self::deleting(function($model){
        //     ... code here
        // });

        self::deleted(function($model){
            $mueble_id = $model->mueble_id;
            $dataJson = $model->presupuesto->data_json;

            $dataJson = json_decode($dataJson, JSON_FORCE_OBJECT);
            
            $items = $dataJson['items'];
            $newItems = collect();
            $count = 0;
            

            foreach ($items as $key => $item) {
                if( explode('*', $item['item_name'])[1] == $mueble_id && $count === 0 ) {
                    $count++;
                } else {
                    $newItems->push($items[$key]);
                }
            }

            // dd($items, $newItems);

            $dataJson['items'] = $newItems->toArray();
            $dataJson = json_encode($dataJson);
            $model->presupuesto->data_json = $dataJson;
            $model->presupuesto->save();
        });
    }
}