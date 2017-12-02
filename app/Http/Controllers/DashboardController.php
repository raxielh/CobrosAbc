<?php

namespace App\Http\Controllers;

use Cookie;
use Request;
use App\Cobro;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($cobro)
    {
    	Cookie::forget('cobro');
      Cookie::queue('cobro',$cobro,9999);
			//return Request::cookie('nombre');
    	$nombre_cobro = Cobro::findOrFail($cobro);
    	$data = array(
    				"cobro"=>$cobro,
    				"nombre_cobro"=>$nombre_cobro,
					  "datos" =>null
				    );
      return view('dashboard.home',compact('data'));
    }

}
