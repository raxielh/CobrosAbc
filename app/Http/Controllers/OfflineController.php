<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Cookie;
use App\Key;
use App\Cobro;

class OfflineController extends Controller
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
        $p =  DB::table('key')
                ->where('cobro_id',$cobro)
                ->get();
        $data = array(
                    "cobro"=>$cobro,
                    "nombre_cobro"=>$nombre_cobro,
                    "datos" =>$p
                );
        return view('offline.index',compact('data'));
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
        $pp = new Key();
        $pp->key = random_int(111111111, 999999999);
        $pp->cobro_id = Cookie::get('cobro');
        $pp->save();
        return redirect('offline');
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
