<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class local extends Model
{
    protected $guarded = ['id'];
    protected $table = 'locales';
    
    private function guardarLogo($fileFoto){
        $extension = $fileFoto->getClientOriginalExtension();
        $filename = uniqid();
        Storage::disk('logo_locales')->put($filename.'.'.$extension,  File::get($fileFoto));
        $urlfinal = $filename . '.' . $extension;

        return $urlfinal;
    }

    private function eliminarLogoUrl(){
        $logoUrl = $this->getOriginal('logo_url');
        return Storage::disk('logo_locales')->delete($logoUrl);
    }

    public function actualizar(array $options = []){
        $data = collect($options);

        if($this->exists){
            $data = $data->except(['_token', '_method']);
            
            if( array_key_exists('logo_url', $data->toArray()) ){
                $this->eliminarLogoUrl();
                $logoUrl = $this->guardarLogo($data['logo_url']) ;
                $data['logo_url'] = $logoUrl;
            }
        } 

        $this->update( $data->toArray() );
    }

    // mutators
    public function getLogoUrlAttribute($value)
    {
        if ($value == null) {
            return url("/img/local_default.png");
        }else{
        	return url("/storage/logo_locales").'/'.$value;
        }

        return $imagen;
    }

    // events
    public static function boot()
    {
        parent::boot();

        self::creating(function($local){
            if ($local->logo_url) {
                $logoUrl = $local->guardarLogo($local->logo_url);
                $local->logo_url = $logoUrl;
            }
        });

        self::updating(function($local){
            $local->wasChanged('logo_url');
        });

        self::deleted(function($local){
            $local->eliminarLogoUrl();
        });
    }


}