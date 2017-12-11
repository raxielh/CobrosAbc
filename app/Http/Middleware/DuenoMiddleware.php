<?php

namespace App\Http\Middleware;

use Closure;
use App\Cobro;
use App\Asignar_rol;
use Illuminate\Support\Facades\DB;

class DuenoMiddleware
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
        $url=(url()->full());
        $values = parse_url($url);
        $host = explode('/',$values['path']);
        $cobro=$host[2];
        $user_id=$request->user()->id;
        $cobro_sql =  DB::table('cobros')
                ->where('user_id',$user_id)
                ->where('id',$cobro)
                ->get();

        $asignar_sql =  DB::table('asignar_rol')
                ->where('user_id',$user_id)
                ->where('cobro_id',$cobro)
                ->get();

        if (count($cobro_sql)!=0 || count($asignar_sql)!=0 ) {
            return $next($request);
        }else{
            abort(403, "¡No tienes permisos!");
        }



        
        
    }
}
