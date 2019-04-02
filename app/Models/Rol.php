<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Rol extends EntrustRole
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = "roles";

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class);
    }

}
