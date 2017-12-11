<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Asignar_rol;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $cobro= Asignar_rol::all()->where('user_id',$id);
        if(count($cobro)>0){
            $cobro= $cobro[1]->cobro_id;
            return redirect('dashboard/'.$cobro);
        }else{
            return view('home');
        }
        
    }
}
