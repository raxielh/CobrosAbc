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

class CobradorController extends Controller
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
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>null
                );
        return view('cobrador.index',compact('data'));
    }

    public function get_data_cobrador()
    {/*
        $cobro = Cookie::get('cobro');
        $data = Asignar_rol::where('cobro_id',$cobro)->get();
        //return response()->json($data);
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('barrio').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
        })->addColumn('action2', function ($data){
                return '<a href="#" onclick="borrar('.$data->id.')" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent btn-red"><i class="material-icons">delete_forever</i> Borrar</a>';
        })->make(true);*/

        $cobro = Cookie::get('cobro');
        //$data = Cliente::where('cobro_id',$cobro)->get();
        $data =  DB::table('asignar_rol')
                ->join('users', 'asignar_rol.user_id', '=', 'users.id')
                ->selectRaw('users.*')
                ->where('asignar_rol.cobro_id',$cobro)
                ->get();
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('cobrador').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
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
            $cobrador->save();
            $asignar = new Asignar_rol();
            $asignar->user_id = $cobrador->id;
            $asignar->rol_id = 1;
            $asignar->cobro_id = Cookie::get('cobro');
            $asignar->save();
            return "Cobrador creado con exito";
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
      return view('cobrador.edit',compact('data'));
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
        $cobrador->update();
        return "Cobrador editado con exito";
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
        $a = DB::table('asignar_rol')->where('user_id',$id)->delete();       
        $Cobrador = Cobrador::findOrFail($id);
        $Cobrador->delete();
        return "Cobrador borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }
}
