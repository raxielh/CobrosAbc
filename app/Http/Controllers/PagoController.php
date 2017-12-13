<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Cobro;
use App\Cliente;
use App\Prestamo;
use App\Interes;
use App\PagoPrestamo;
use Auth;
use Exception;

class PagoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');

      $this->middleware('cobrador', ['except' => ['index', 'store','get_data_pago','show']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobro = Cookie::get('cobro');
        $nombre_cobro = Cobro::findOrFail($cobro);
        $p =  DB::table('prestamos')
                ->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')
                ->selectRaw('*,FORMAT(monto,0) as mascara_monto,FORMAT((monto*interes/100)+monto,0) as valor_prestamo, FORMAT(((monto*interes/100)+monto)/tiempo,0) as cuota,prestamos.id as ide')
                ->where('clientes.cobro_id',$cobro)
                ->orderByRaw('orden DESC')
                ->get();
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>$p
                );
        return view('pago.index',compact('data'));
    }

    public function store(Request $request)
    {
      try {
        $pp = new PagoPrestamo();
        $pp->monto = $request->monto;
        $pp->fecha = $request->fecha;
        $pp->referencia = $request->referencia;
        $pp->prestamo_id = $request->prestamo;
        $pp->cobro_id = Cookie::get('cobro');
        $pp->user_id = Auth::user()->id;
        $pp->save();
        return "Pago exitoso";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

    public function show($id)
    {
      $cobro = Cookie::get('cobro');
      $nombre_cobro = Cobro::findOrFail($cobro);
      $p =  DB::table('prestamos')
              ->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')
              ->selectRaw('*,FORMAT(monto,0) as mascara_monto,FORMAT((monto*interes/100)+monto,0) as valor_prestamo, FORMAT(((monto*interes/100)+monto)/tiempo,0) as cuota,((monto*interes/100)+monto)/tiempo as cuota_m,prestamos.id as ide')
              ->where('clientes.cobro_id',$cobro)
              ->where('prestamos.id',$id)
              ->orderByRaw('orden DESC')
              ->get();
       $pp =  DB::table('pago_prestamos')
              ->selectRaw('sum(monto) as pagado,count(*) as restantes')
              ->where('pago_prestamos.cobro_id',$cobro)
              ->where('prestamo_id',$id)
              ->get();
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$p,
                  "pp" =>$pp
              );
      return view('pago.edit',compact('data'));
    }

    public function destroy($id)
    {
      try {
        $prestamo = PagoPrestamo::findOrFail($id);
        $prestamo->delete();
        return "Pago Prestamo borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

        public function get_data_pago($id)
        {
            $cobro = Cookie::get('cobro');
            /*$data = PagoPrestamo::where('cobro_id',$cobro)->where('prestamo_id',$id)->selectRaw('*,FORMAT(monto,0) as mascara_monto')->get();*/
            $data =  DB::table('pago_prestamos')
              ->join('users', 'pago_prestamos.user_id', '=', 'users.id')
              ->selectRaw('*,FORMAT(monto,0) as mascara_monto,pago_prestamos.id as ide,users.name as nombre')
              ->where('prestamo_id',$id)
              ->get();
            return Datatables::of($data)->addColumn('action', function ($data){
                    return '<a href="'.url('prpago').'/'.$data->ide.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
            })->addColumn('action2', function ($data){
                    return '<a href="#" onclick="borrar('.$data->ide.')" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent btn-red oculto"><i class="material-icons">delete_forever</i> Borrar</a>';
            })->make(true);
        }

}
