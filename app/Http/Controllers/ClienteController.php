<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Cobro;
use App\Cliente;
use App\Barrio;
use Exception;

class ClienteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
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
        $barrio = Barrio::where('cobro_id',$cobro)->pluck('nombre', 'id');
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>$barrio
                );
        return view('clientes.index',compact('data'));
    }

    public function get_data_clientes()
    {
        $cobro = Cookie::get('cobro');
        //$data = Cliente::where('cobro_id',$cobro)->get();
       $data =  DB::table('clientes')
                ->join('barrios', 'clientes.barrio_id', '=', 'barrios.id')
                ->select('clientes.*','barrios.nombre as barrio')
                ->where('clientes.cobro_id',$cobro)
                ->get();
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('clientes').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
        })->addColumn('action2', function ($data){
                return '<a href="#" onclick="borrar('.$data->id.')" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent btn-red"><i class="material-icons">delete_forever</i> Borrar</a>';
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
        $cliente = new Cliente();
        $cliente->nombre = ucwords($request->nombre);
        $cliente->identificacion = $request->identificacion;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->referencia = $request->referencia;
        $cliente->barrio_id = $request->barrio;
        $cliente->cobro_id = Cookie::get('cobro');
        $cliente->save();
        return "Cliente creado con exito";
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
      $d=Cliente::findOrFail($id);
      $barrio = Barrio::where('cobro_id',$cobro)->get();
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$d,
                  "barrio" => $barrio
              );
      return view('clientes.edit',compact('data'));
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
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = ucwords($request->nombre);
        $cliente->identificacion = $request->identificacion;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->referencia = $request->referencia;
        $cliente->barrio_id = $request->barrio;
        $cliente->cobro_id = Cookie::get('cobro');
        $cliente->update();
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
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return "Cliente borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }
}
