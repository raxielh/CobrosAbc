<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Cobro;
use App\Cobrador;
use App\Asignar_rol;
use Exception;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.usuarios.index');
    }

    public function get_data_usuarios()
    {

        $cobro = Cookie::get('cobro');
        //$data = Cliente::where('cobro_id',$cobro)->get();
        $data =  DB::table('users')
                ->get();
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('usuarios').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
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
            $cobrador = new Cobrador();
            $cobrador->name = ucwords($request->name);
            $cobrador->email = $request->email;
            $cobrador->password =bcrypt($request->password);
            $cobrador->direccion = $request->direccion;
            $cobrador->telefono = $request->telefono;
            $cobrador->save();
            return "Usuario creado con exito";
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
      $d=Cobrador::findOrFail($id);
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$d
              );
      return view('administrador.usuarios.edit',compact('data'));
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
        $cobrador = Cobrador::findOrFail($id);
        $cobrador->name = ucwords($request->name);
        $cobrador->email = $request->email;
        $cobrador->direccion = $request->direccion;
        $cobrador->telefono = $request->telefono;
        $cobrador->update();
        return "Usuario editado con exito";
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
        $Cobrador = Cobrador::findOrFail($id);
        $Cobrador->delete();
        return "Usuario borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }
}
