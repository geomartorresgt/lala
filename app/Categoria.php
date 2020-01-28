<?php

namespace App;

use Html2Text\Html2Text;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'clave', 'descripcion', 'inicio', 'icono'];
    protected $appends = ['icono_url', 'resumen'];

    public function publicaciones()
    {
        return $this->belongsToMany(Publicacion::class, 'categorias_publicaciones');
    }

    public function actualizar(array $options = []){
        $data = collect($options);

        if($this->exists){
            $data = $data->only($this->fillable);

            if (!$data->has('inicio')) {
                $data['inicio'] = false;
            }
            
            if( array_key_exists('icono', $data->toArray()) ){
                $this->eliminarIcono();
                $icono = $this->guardarIcono($data['icono']) ;
                $data['icono'] = $icono;
            }
        } 

        $this->update( $data->toArray() );
    }

    public function getResumenAttribute()
    {
        $html = $this->descripcion;
        $html2TextConverter = new Html2Text($html);
        $text =  str_replace("\n", ' ', $html2TextConverter->getText());
        return $text;
    }

    public function getIconoUrlAttribute()
    {
        $value = $this->icono;
        if ($value === null || $value === '') {
            return url("img/publicacion.jpg");
        }else{
        	return url("/storage/iconos_categorias").'/'.$value;
           return url("").$value;
 
        }

        return $value;
    }
    
    public static function boot()
    {
        parent::boot();

        self::creating(function($categoria){
            if ($categoria->icono) {
                $iconoUrl = $categoria->guardarIcono($categoria->icono);
                $categoria->icono = $iconoUrl;
            }
        });

        self::deleted(function($categoria){
            $categoria->eliminarIcono();
        });
    }

    private function eliminarIcono(){
        $icono = $this->getOriginal('icono');
        return Storage::disk('iconos_categorias')->delete($icono);
    }

    private function guardarIcono($fileFoto){
        $extension = $fileFoto->getClientOriginalExtension();
        $filename = uniqid();
        Storage::disk('iconos_categorias')->put($filename.'.'.$extension,  File::get($fileFoto));
        $urlfinal = $filename . '.' . $extension;

        return $urlfinal;
    }

}
