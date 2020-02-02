<?php

namespace App;

use Html2Text\Html2Text;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Publicacion extends Model
{
    protected $table = 'publicaciones';
    protected $fillable = ['titulo', 'contenido', 'banner', 'publicado'];
    protected $with = ['categorias'];
    protected $appends = ['banner_url', 'resumen'];

    // relationships
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categorias_publicaciones');
    }

    public function addCategorias(Array $categorias)
    {
        $this->categorias()->detach();
        $this->categorias()->attach($categorias);
    }

    public function tieneCategoria($categoriaId)
    {
        $result = $this->categorias->first(function($categoria) use ($categoriaId){
            return $categoria->id === $categoriaId;
        });

        if ($result) return true;

        return false;
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

    // mutators
    public function getResumenAttribute()
    {
        $html = $this->contenido;
        $html2TextConverter = new Html2Text($html);
        $text =  str_replace("\n", ' ', $html2TextConverter->getText());
        return $text;
    }

    public function getBannerUrlAttribute()
    {
        $value = $this->banner;
        if ($value === null || $value === '') {
            return url("img/publicacion.jpg");
        }else{
        	return url("/storage/banners_publicaciones").'/'.$value;
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
        return urlencode($value);
    }

    // scope
    public function scopeFindBySlug($query, $slug)
    {
        $slug = strtolower($slug);
        return $query->where('slug', $slug)->first();
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($publicacion){
            $publicacion->slug = $publicacion->titulo;

            if ($publicacion->banner) {
                $bannerUrl = $publicacion->guardarLogo($publicacion->banner);
                $publicacion->banner = $bannerUrl;
            }
        });

        self::deleted(function($publicacion){
            $publicacion->eliminarBanner();
        });

        self::updating(function($publicacion){
            $publicacion->slug = $publicacion->titulo;
        });
    }

    private function eliminarBanner(){
        $banner = $this->getOriginal('banner');
        return Storage::disk('banners_publicaciones')->delete($banner);
    }

    private function guardarLogo($fileFoto){
        $extension = $fileFoto->getClientOriginalExtension();
        $filename = uniqid();
        Storage::disk('banners_publicaciones')->put($filename.'.'.$extension,  File::get($fileFoto));
        $urlfinal = $filename . '.' . $extension;

        return $urlfinal;
    }
}
