<?php

namespace App\Http\Middleware;

use App\Config;
use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
/*
        //LLamar a la función para obtener el tiempo
        $config = Config::getConfig('duracion_sesion');

        $tiempo= 60 * $config->value;

        if (Auth::check()) {
            if(!$request->session()->has('session_user'))
            {
                $request->session()->put('session_user', time());
                return $next($request);
            }else{
                if (time() - $request->session()->get('session_user') > $tiempo)
                    // if (true)
                {
                    Auth::logout();
                    $request->session()->flush();
                    flash('Su sesión ha expirado')->error();
                    return redirect('/login');
                }else{
                    $request->session()->put('session_user', time());
                    return $next($request);
                }
            }
        }else{
            return $next($request);
        }
*/
        return $next($request);    
    }
}
