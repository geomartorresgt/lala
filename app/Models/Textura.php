<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Textura extends Model
{
    const TIPO_TEXTURA = [
        1 => 'Pared',
        2 => 'Piso',
    ];

    protected $table = 'texturas';
    protected $guarded = ['id'];
    protected $fillable = ['nombre', 'archivo', 'tipo', 'activo'];
    protected $appends = ['img','tipo_textura'];

    public function getTipoTexturaAttribute($value)
    {
        return TEXTURA::TIPO_TEXTURA[$this->tipo];
    }

    private function guardarArchivo($fileFoto){
        $extension = $fileFoto->getClientOriginalExtension();
        $filename = uniqid();
        Storage::disk('texturas')->put($filename.'.'.$extension,  File::get($fileFoto));
        $urlfinal = $filename . '.' . $extension;

        return $urlfinal;
    }

    private function eliminarArchivo(){
        $archivo = $this->getOriginal('archivo');
        return Storage::disk('texturas')->delete($archivo);
    }

    public function actualizar(array $options = []){
        $data = collect($options);

        if($this->exists){
            $data = $data->except(['_token', '_method']);
            
            if( array_key_exists('archivo', $data->toArray()) ){
                $this->eliminarArchivo();
                $archivo = $this->guardarArchivo($data['archivo']) ;
                $data['archivo'] = $archivo;
            }
        }

        if ( !$data->has('activo') ) {
            $data['activo'] = 0;
        }

        $this->update( $data->toArray() );
    }

    // mutators
    public function getImgAttribute()
    {
        $value = $this->archivo;
        if ($value == null | $value == "") {
            return url("/img/local_default.png");
        }

        return url("/storage/texturas").'/'.$value;
    }

    // events
    public static function boot()
    {
        parent::boot();

        self::creating(function($textura){
            if ($textura->archivo) {
                $archivo = $textura->guardarArchivo($textura->archivo);
                $textura->archivo = $archivo;
            }
        });

        self::updating(function($textura){
            $textura->wasChanged('archivo');
        });

        self::deleted(function($textura){
            $textura->eliminarArchivo();
        });
    }
}
