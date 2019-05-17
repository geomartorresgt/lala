<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Mueble extends Model
{

    const TIPO_MUEBLE = [
        1 => 'Floor Items',
        2 => 'Wall Items',
        3 => 'In Wall Items',
        7 => 'In Wall Floor Items',
        8 => 'On Floor Items',
        9 => 'Wall Floor Items'
    ];

    protected $guarded = ['id'];
    protected $table = 'muebles';
    protected $appends = ['nombre_categoria', 'object_image', 'object_js'];
    
    public function categoria(){
        return $this->belongsTo(CategoriaMueble::class, 'categoria_mueble_id');
    }

    public function getNombreCategoriaAttribute(){
        return ucwords($this->categoria->nombre);
    }

    public function addDatos($data){
        $fileDirectorioUrl = $this->guardarZip($data['directorio_url']);
        $fotoUrl = $this->guardarFoto($fileFoto);

        $data = collect($data);

        if ($fileDirectorioUrl) {
            $this->fill(
                $data->except('directorio_url', '_token')->toArray()
            );
            $this->directorio_url = $fileDirectorioUrl;
            $this->foto_url = $fotoUrl;
        } else {
            // Error descomprimiendo el archivo...
            // dd('error');
        }
    }

    private static function guardarZip($fileDirectorioUrl){
        $pathName = $fileDirectorioUrl->getPathname();
        $zip = new \ZipArchive();
        $zipOpen = $zip->open($pathName);

        if ($zipOpen === TRUE) {
            $nombre = $newname = str_random(32);
            $zip->extractTo(storage_path('app/public/muebles/'.$nombre.'/'));
            $zip->close();
            self::renameFilesJson($nombre);
            return $nombre;
        } else {
            // Error descomprimiendo el archivo...
            return null;
        }
    }

    private static function guardarFoto($fileFoto){
        $extension = $fileFoto->getClientOriginalExtension();
        $filename = uniqid();
        Storage::disk('foto_muebles')->put($filename.'.'.$extension,  File::get($fileFoto));
        $urlfinal = $filename . '.' . $extension;

        return $urlfinal;
    }

    private static function creatingMueble(array $options = []) {

    }

    public function getFotoUrlAttribute($imagen)
    {
        if ($imagen==null) {
            return url("/img/user_default.jpg");
        }else{
        	return url("/storage/foto_muebles").'/'.$imagen;
        }

        return $imagen;
    }

    private static function renameFilesJson($directorio)
    {
        $path = Storage::disk('muebles')->getAdapter()->getPathPrefix().$directorio.'/';
        foreach (glob($path."*.{js,json}", GLOB_BRACE) as $filename) {
            $file = realpath($filename);
            if (!rename($file, $path.'object.js' )) {
                return false;
            }
        }
        return true;
    }

    public static function create(array $options = [])
    {
        $directorioUrl = self::guardarZip($options['directorio_url']);
        $fotoUrl = self::guardarFoto($options['foto_url']);
        $options['directorio_url'] = $directorioUrl;
        $options['foto_url'] = $fotoUrl;

        // before save code 
        $class = __CLASS__;
        $obj = new $class($options);
        $obj->save();
        return $obj;


        // after save code
    }

    public function actualizar(array $options = []){
        $data = collect($options);

        if($this->exists){
            $data = $data->except(['_token', '_method']);

            if( array_key_exists('directorio_url', $data->toArray())){
                $this->eliminarDirectoriUrl();
                $directorioUrl = self::guardarZip($data['directorio_url']);
                $data['directorio_url'] = $directorioUrl;
            }
            
            if( array_key_exists('foto_url', $data->toArray()) ){
                $this->eliminarFotoUrl();
                $fotoUrl = self::guardarFoto($data['foto_url']);
                $data['foto_url'] = $fotoUrl;
            }
        } 

        $this->update( $data->toArray() );
    }

    private function eliminarDirectoriUrl(){
        $directorioUrl = $this->getOriginal('directorio_url');
        return Storage::disk('muebles')->deleteDirectory($directorioUrl);
    }

    private function eliminarFotoUrl(){
        $fotoUrl = $this->getOriginal('foto_url');
        return Storage::disk('foto_muebles')->delete($fotoUrl);
    }

    public static function boot()
    {
        parent::boot();

        // self::creating(function($model){
        // ... code here
        // });

        // self::created(function($model){
        // ... code here
        // });

        // self::updating(function($model){
        //     ... code here
        // });

        // self::updated(function($model){
        // ... code here
        // });

        // self::deleting(function($model){
        // ... code here
        // });

        self::deleted(function($model){
            $model->eliminarDirectoriUrl();
            $model->eliminarFotoUrl();
        });
    }

    public function getObjectImageAttribute()
    {
        $directorio = $this->directorio_url;
        $image = array_filter(Storage::disk('muebles')->files($directorio), function ($item) {return strpos($item, 'jpg');});
        $image = array_values($image);
        if(array_key_exists(0, $image)){
            return url("/storage/muebles").'/'.$image[0];
        }

        return '';
    }

    public function getObjectJsAttribute()
    {
        $directorio = $this->directorio_url;
        $objectJs = array_filter(Storage::disk('muebles')->files($directorio), function ($item) {return strpos($item, 'js');});
        $objectJs = array_values($objectJs);

        if(array_key_exists(0, $objectJs)){
            return url("/storage/muebles").'/'.$objectJs[0];
        }
        
        return '';
    }

    // relaciones
    public function presupuestos()
    {
        return $this->belongsToMany(Presupuesto::class, 'muebles_presupuesto', 'mueble_id', 'presupuesto_id')
                ->withTimestamps()
                ->withPivot(
                    'presupuesto_id', 
                    'mueble_id'
                );
    }

}