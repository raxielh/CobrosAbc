<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Cobro;
use App\Interes;

class InteresController extends Controller
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
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>null
                );
        return view('interes.index',compact('data'));
    }

    public function get_data_interes()
    {
        $cobro = Cookie::get('cobro');
        $data = Interes::where('cobro_id',$cobro)->get();
        //response()->json($data);
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('interes').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
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
        $interes = new Interes();
        $interes->numero = $request->numero;
        $interes->cobro_id = Cookie::get('cobro');
        $interes->save();
        return "Interes creado con exito";
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
      $d=Interes::findOrFail($id);
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$d
              );
      return view('interes.edit',compact('data'));
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
        $interes = Interes::findOrFail($id);
        $interes->numero = $request->numero;
        $interes->cobro_id = Cookie::get('cobro');
        $interes->update();
        return "Interes editado con exito";
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
        $interes = Interes::findOrFail($id);
        $interes->delete();
        return "Interes borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }
}
