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
use Exception;

class PrestamoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('cobrador');
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
        $cliente = Cliente::where('cobro_id',$cobro)->get();
        $interes = Interes::where('cobro_id',$cobro)->get();
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>$cliente,
                    "interes"=>$interes
                );
        return view('prestamos.index',compact('data'));
    }

    public function ordenar()
    {
        $cobro = Cookie::get('cobro');
        $nombre_cobro = Cobro::findOrFail($cobro);
        $p =  DB::table('prestamos')
                ->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')
                ->selectRaw('*,FORMAT(monto,0) as mascara_monto,FORMAT((monto*interes/100)+monto,0) as valor_prestamo, FORMAT(((monto*interes/100)+monto)/tiempo,0) as cuota,prestamos.id as ide')
                ->where('clientes.cobro_id',$cobro)
                ->orderByRaw('orden ASC')
                ->get();
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>$p
                );
        return view('prestamos.ordenar',compact('data'));
    }

    public function get_data_prestamo()
    {
        $cobro = Cookie::get('cobro');
        //$data = Cliente::where('cobro_id',$cobro)->get();
        $data =  DB::table('prestamos')
                ->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')
                ->selectRaw('*,FORMAT(monto,0) as mascara_monto,FORMAT((monto*interes/100)+monto,0) as valor_prestamo, FORMAT(((monto*interes/100)+monto)/tiempo,0) as cuota,prestamos.id as ide')
                ->where('clientes.cobro_id',$cobro)
                ->get();
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('prestamo').'/'.$data->ide.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i></a>';
        })->addColumn('action2', function ($data){
                return '<a href="#" onclick="borrar('.$data->ide.')" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent btn-red"><i class="material-icons">delete_forever</i></a>';
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $prestamo = new Prestamo();
        $prestamo->interes = $request->interes;
        $prestamo->monto = $request->monto;
        $prestamo->fecha = $request->fecha;
        $prestamo->tiempo = $request->tiempo;
        $prestamo->referencia = $request->referencia;
        $prestamo->cliente_id = $request->cliente;
        $prestamo->tipo_prestamo_id = 1;
        $prestamo->cobro_id = Cookie::get('cobro');
        $prestamo->save();
        return "Prestamo creado con exito";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $cobro = Cookie::get('cobro');
      $nombre_cobro = Cobro::findOrFail($cobro);
      $prestamo = DB::table('prestamos')
                ->selectRaw('*,FORMAT(monto,0) as mascara_monto,FORMAT((monto*interes/100)+monto,0) as valor_prestamo, FORMAT(((monto*interes/100)+monto)/tiempo,0) as cuota,prestamos.id as ide')
                ->where('prestamos.cobro_id',$cobro)
                ->where('prestamos.id',$id)
                ->get();
      $cliente = Cliente::where('cobro_id',$cobro)->get();
      $interes = Interes::where('cobro_id',$cobro)->get();
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$prestamo,
                  "cliente" =>$cliente,
                  "interes" => $interes
              );
      return view('prestamos.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $prestamo = Prestamo::findOrFail($id);
        $prestamo->interes = $request->interes;
        $prestamo->monto = $request->monto;
        $prestamo->fecha = $request->fecha;
        $prestamo->tiempo = $request->tiempo;
        $prestamo->referencia = $request->referencia;
        $prestamo->cliente_id = $request->cliente;
        $prestamo->tipo_prestamo_id = 1;
        $prestamo->cobro_id = Cookie::get('cobro');
        $prestamo->update();
        return "Cliente editado con exito";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $prestamo = Prestamo::findOrFail($id);
        $prestamo->delete();
        return "Prestamo borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

    public function plus($id)
    {
      try {
        $prestamo  = Prestamo::findOrFail($id);
        $orden_actual=$prestamo->orden;
        $prestamo->orden = $orden_actual+1;
        $prestamo->update();
        return back();
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

    public function minus($id)
    {
      try {
        $prestamo  = Prestamo::findOrFail($id);
        $orden_actual=$prestamo->orden;
        $prestamo->orden = $orden_actual-1;
        $prestamo->update();
        return back();
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }

}
