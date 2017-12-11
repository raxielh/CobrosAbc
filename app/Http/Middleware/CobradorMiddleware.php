<?php

namespace App\Http\Middleware;

use Closure;
use App\Asignar_rol;

class CobradorMiddleware
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
        $id=$request->user()->id;
        $cobro= Asignar_rol::all()->where('user_id',$id);
        if (count($cobro)>0) {
            abort(403, "¡No tienes permisos!");
        }
        return $next($request);
    }
}
