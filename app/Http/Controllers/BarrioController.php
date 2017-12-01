<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cobro;
use App\Barrio;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cobro)
    {
        $nombre_cobro = Cobro::findOrFail($cobro);
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>null
                );
        return view('barrios.index',compact('data'));
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
    public function store(Request $request,$cobro)
    {
      try {
        $cobro = new Cobro();
        $cobro->nombre = ucwords($request->nombre);
        $cobro->referencia = $request->referencia;
        $cobro->color = $cobro;
        $cobro->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
