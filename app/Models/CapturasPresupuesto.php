<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CapturasPresupuesto extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    protected $table = 'capturas_presupuesto';

    public function presupuesto(){
        return $this->belongsToMany(Presupuesto::class);
    }

    public function getImgUrlAttribute($imagen)
    {
        if ($imagen == null) {
            return url("/img/user_default.jpg");
        } else if(!$this->exists /*|| !$this->wasRecentlyCreated*/ ){
            return $imagen;
        }else{
        	return url("/storage/editor/capturas").'/'.$imagen;
        }

        return $imagen;
    }

    private function eliminarFotoUrl(){
        $imgUrl = $this->getOriginal('img_url');
        return Storage::disk('editor_capturas')->delete($imgUrl);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $base64_image = $model->img_url;
            if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
                $image = substr($base64_image, strpos($base64_image, ',') + 1);
                $filename = uniqid();
                $extension = 'png';
                $image = base64_decode($image);
                $imageUrl = $filename.'.'.$extension;
                Storage::disk('editor_capturas')->put($imageUrl, $image);
    
                $model->img_url = $imageUrl;
                return true;
            }
        });

        self::deleted(function($model){
            $model->eliminarFotoUrl();
        });
    }
}
