<?php

namespace App\Http\Controllers;

use Cookie;
use Request;
use App\Cobro;
use App\Capital;
use Exception;
class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('dueno');
    }

    public function index($cobro)
    {
    	Cookie::forget('cobro');
        Cookie::queue('cobro',$cobro,9999*2);
			//return Request::cookie('nombre');
        $cap = Capital::where('cobro_id',$cobro)
               ->selectRaw('FORMAT(sum(monto),0) as total')->get();
    	$nombre_cobro = Cobro::findOrFail($cobro);
    	$data = array(
    				"cobro"=>$cobro,
    				"nombre_cobro"=>$nombre_cobro,
					"datos" =>$cap
				    );
      return view('dashboard.home',compact('data'));
    }

}
