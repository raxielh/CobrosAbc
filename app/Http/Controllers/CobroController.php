<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Cobro;


class CobroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Cobro::where('user_id',Auth::user()->id)->get();
      return response()->json($data);
      //return view('home',compact('data'));
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
        $cobro = new Cobro();
        $cobro->nombre = ucwords($request->nombre);
        $cobro->localidad = $request->localidad;
        $cobro->color = $request->color;
        $cobro->user_id = Auth::user()->id;
        $cobro->save();
        return "Cobro creado con exito";
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
        $cobro = Cobro::findOrFail($id);
        return response()->json($cobro);
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
      try {
        $cobro = Cobro::findOrFail($id);
        $cobro->nombre = ucwords($request->nombre);
        $cobro->localidad = $request->localidad;
        $cobro->color = $request->color;
        $cobro->update();
        return "Cobro Editado con exito";
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
          $cobro = Cobro::findOrFail($id);
          $cobro->delete();
          return "Cobro borrado";
        } catch (Exception $e) {
          return "error fatal ->".$e->getMessage();
        }

    }
}
