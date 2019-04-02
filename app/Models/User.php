<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $appends = ["nombre_completo", "rol"];

    protected $table = "users";

    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }

	public function getNombreCompletoAttribute()
    {
        return ucwords("$this->nombres $this->apellidos");
    }

    public function getNombreCompleto()
    {
    	return ucwords("$this->nombres $this->apellidos");
    }

    public function getRol()
    {
        $rol = $this->roles()->first();
        return $rol;
    }

    public function getRolId()
    {
        $rol = $this->roles()->first();
        if($rol){
            return $rol->id;
        }
        return null;
    }

    public function getRolAttribute()
    {
        $rol_name = '';
        $rol = $this->roles()->first();
        if ($rol) {
            $rol_name = $rol->display_name;
        }
        return ucwords($rol_name);
    }

    public function getFotoPerfilAttribute($imagen)
    {
        if ($imagen==null) {
            return url("/img/user_default.jpg");
        }else{
        	return url("/storage/img/foto_perfil").'/'.$imagen;
           return url("").$imagen;
 
        }

        return $imagen;
    }

    public function permiso($user_id, $permiso)
    {
        $user = $this;
        if ($user_id == $user->id || $user->can($permiso)) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarRol($rol_name)
    {
        if( $this->roles->where('name',$rol_name)->count() > 0){
            return true;
        }

        return false;
    }

}














