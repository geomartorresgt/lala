<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    protected $guarded = ['id'];
    protected $table = 'muebles';

    public static function guardar($data){
        $fileDirectorioUrl = $data['directorio_url'];
        $nombre = $fileDirectorioUrl->getClientOriginalName();
        $data = collect($data);
        $zip = new \ZipArchive();
        $zipOpen = $zip->open($fileDirectorioUrl->getPathname());

        if ($zipOpen === TRUE) {
            $name = $newname = str_random(32);

            $mueble = new Mueble();
            $mueble->fill(
                $data->except('directorio_url', '_token')->toArray()
            );

            $mueble->directorio_url = $name;

            $zip->extractTo(storage_path('app/public/muebles/'.$name.'/'));
            $zip->close();

            $mueble->save();

        } else {
            // Error descomprimiendo el archivo...
            dd('error');
        }
    }
}