<?php

namespace App\Models;


use Zizaco\Entrust\EntrustPermission;

class Permiso extends EntrustPermission
{
    protected $guarded = ['id','created_at','updated_at'];

    protected $table = 'permisos';

    public function roles(){
        return $this->belongsToMany(Rol::class);
    }
}
