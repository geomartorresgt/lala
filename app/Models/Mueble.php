<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Mueble extends Model
{
    protected $guarded = ['id'];
    protected $table = 'muebles';
    protected $appends = ["nombre_categoria"];
    
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
           return url("").$imagen;
 
        }

        return $imagen;
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
        // ... code here
        // });

        // self::updated(function($model){
        // ... code here
        // });

        self::deleting(function($model){
            $model->eliminarDirectoriUrl();
            $model->eliminarFotoUrl();
        });

        // self::deleted(function($model){
        // ... code here
        // });
    }

    private function deleteFile(){

    }


}