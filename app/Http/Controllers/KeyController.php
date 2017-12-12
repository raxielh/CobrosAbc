<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Key;
use App\Cobro;
use App\Prestamo;
use App\PagoPrestamo;
use Exception;

class KeyController extends Controller
{
    public function __construct()
    {
      $this->middleware('cors');
    }

    public function show($id)
    {
        $key = Key::all()->where('key',$id);
        return response()->json($key);
    }
    
    public function test()
    {
        return 'true';
    }

    public function prestamos($cobro)
    {
        $p =  DB::table('prestamos')
                ->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')
                ->selectRaw('*,FORMAT(monto,0) as mascara_monto,FORMAT((monto*interes/100)+monto,0) as valor_prestamo, FORMAT(((monto*interes/100)+monto)/tiempo,0) as mascaracuota,ROUND(((monto*interes/100)+monto)/tiempo) as cuota,prestamos.id as ide')
                ->where('clientes.cobro_id',$cobro)
                ->orderByRaw('orden ASC')
                ->get();
        return response()->json($p);
    }

    public function add_pago($id1,$id2,$key)
    {
      try {
        $data = DB::table('key')->where('key',$key)->get();
        if(count($data)==0){
            return 'error';
        }else{
            $d = DB::table('prestamos')->where('id',$id1)->get();
            $pp = new PagoPrestamo();
            $pp->monto = $id2;
            $pp->fecha = date('Y-m-d');
            $pp->referencia = 'Offline';
            $pp->prestamo_id = $id1;
            $pp->cobro_id = $d[0]->cobro_id;
            $pp->user_id = 2;
            $pp->save();
            return "Pago exitoso";             
        }

      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

}
