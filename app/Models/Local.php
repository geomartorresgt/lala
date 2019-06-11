<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class local extends Model
{
    protected $guarded = ['id'];
    protected $table = 'locales';
    protected $with = ['muebles'];
    
    public function muebles()
    {
        return $this->belongsToMany(Mueble::class, 'muebles_local')->withPivot('precio');
    }


}