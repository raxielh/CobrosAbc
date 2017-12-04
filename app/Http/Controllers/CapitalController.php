<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Cobro;
use App\Capital;

class CapitalController extends Controller
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
        $cap = Capital::where('cobro_id',$cobro)
                ->selectRaw('FORMAT(sum(monto),0) as total')->get();
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>$cap
                );
        return view('capital.index',compact('data'));
    }

    public function get_data_capital()
    {
        $cobro = Cookie::get('cobro');
        $data = Capital::where('cobro_id',$cobro)
                ->selectRaw('Capital.*,FORMAT(monto,0) as mascara_monto')->get();
        //response()->json($data);
        return Datatables::of($data)->addColumn('action', function ($data){
                return '<a href="'.url('capital').'/'.$data->id.'/edit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored btn-blue"><i class="material-icons">mode_edit</i> Editar</a>';
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
        $capital = new Capital();
        $capital->monto = ($request->monto);
        $capital->referencia = $request->referencia;
        $capital->cobro_id = Cookie::get('cobro');
        $capital->save();
        return "Capital creado con exito";
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
      $d=Capital::findOrFail($id);
      $data = array(
                  "cobro"=>$cobro,
                  "nombre_cobro"=>$nombre_cobro,
                  "datos" =>$d
              );
      return view('capital.edit',compact('data'));
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
        $capital = Capital::findOrFail($id);
        $capital->monto = ($request->monto);
        $capital->referencia = $request->referencia;
        $capital->cobro_id = Cookie::get('cobro');
        $capital->update();
        return "Capital editado con exito";
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
        $capital = Capital::findOrFail($id);
        $capital->delete();
        return "Capital borrado";
      } catch (Exception $e) {
        return "error fatal ->".$e->getMessage();
      }
    }
}
