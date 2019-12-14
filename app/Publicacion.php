<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'publicaciones';
    protected $fillable = ['titulo', 'contenido'];
    protected $with = ['categorias'];

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

    public static function boot()
    {
        parent::boot();

        self::creating(function($publicacion){
        });

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
        
        // self::deleted(function($model){
        // ... code here
        // });
    }
}
