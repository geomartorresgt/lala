<?php

namespace App\Models;

use Carbon\Carbon;
use Html2Text\Html2Text;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = ['banner', 'titulo', 'descripcion', 'fecha', 'publicado'];
    protected $appends = ['banner_url', 'resumen'];

    // mutators
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getFechaAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function actualizar(array $options = []){
        $data = collect($options);

        if($this->exists){
            $data = $data->only($this->fillable);

            if (!$data->has('publicado')) {
                $data['publicado'] = false;
            }
            
            if( array_key_exists('banner', $data->toArray()) ){
                $this->eliminarBanner();
                $banner = $this->guardarLogo($data['banner']) ;
                $data['banner'] = $banner;
            }
        } 

        $this->update( $data->toArray() );
    }

    public function getResumen($countCaracteres)
    {
        $suspensivos = '';
        $max = $countCaracteres;

        if (strlen($this->resumen) > $max ) {
            $suspensivos = '...';
        }

        return substr(trim($this->resumen), 0, $max) . $suspensivos;
    }

    // mutators
    public function getResumenAttribute()
    {
        $html = $this->descripcion;
        $html2TextConverter = new Html2Text($html);
        $text =  str_replace("\n", ' ', $html2TextConverter->getText());
        return $text;
    }

    public function getBannerUrlAttribute()
    {
        $value = $this->banner;
        if ($value === null || $value === '') {
            return url("web/images/700x400.png");
        }else{
        	return url("/storage/banners_eventos").'/'.$value;
           return url("").$value;
 
        }

        return $value;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $this->friendlyUrl($value);
    }

    public function friendlyUrl($value): String
    {
        $value = strtolower($value);
        return str_slug($value, "+");
    }

    // scope
    public function scopeFindBySlug($query, $slug)
    {
        $slug = strtolower($slug);
        return $query->where('slug', $slug);
    }

    public function scopePublicados($query)
    {
        return $query->where('publicado', true);
    }

    public function scopeDestacados($query)
    {
        return $query->where('id','>','0');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($evento){
            $evento->slug = $evento->titulo;
            if ($evento->banner) {
                $bannerUrl = $evento->guardarLogo($evento->banner);
                $evento->banner = $bannerUrl;
            }
        });

        self::deleted(function($evento){
            $evento->eliminarBanner();
        });

        self::updating(function($evento){
            $evento->slug = $evento->titulo;
        });
    }

    private function eliminarBanner(){
        $banner = $this->getOriginal('banner');
        return Storage::disk('banners_eventos')->delete($banner);
    }

    private function guardarLogo($fileFoto){
        $extension = $fileFoto->getClientOriginalExtension();
        $filename = uniqid();
        Storage::disk('banners_eventos')->put($filename.'.'.$extension,  File::get($fileFoto));
        $urlfinal = $filename . '.' . $extension;

        return $urlfinal;
    }
}
