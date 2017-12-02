<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Cobro;
use App\Barrio;

class BarrioController extends Controller
{
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
        return view('barrios.index',compact('data'));
    }

    public function get_data_barrio()
    {
        $cobro = Cookie::get('cobro');
        $data = Barrio::where('cobro_id',$cobro)->get();
        //return response()->json($data);
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('barrio').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
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
        $barrio = new Barrio();
        $barrio->nombre = ucwords($request->nombre);
        $barrio->referencia = $request->referencia;
        $barrio->cobro_id = Cookie::get('cobro');
        $barrio->save();
        return "Barrio creado con exito";
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
      $d=Barrio::findOrFail($id);
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$d
              );
      return view('barrios.edit',compact('data'));
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
        $barrio = Barrio::findOrFail($id);
        $barrio->nombre = ucwords($request->nombre);
        $barrio->referencia = $request->referencia;
        $barrio->cobro_id = Cookie::get('cobro');
        $barrio->update();
        return "Barrio editado con exito";
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
        $barrio = Barrio::findOrFail($id);
        $barrio->delete();
        return "Barrio borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }
}
