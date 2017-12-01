<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\Cobro;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($cobro)
    {

        /*
        Cookie::forget('cobro');
        $nueva_cookie = cookie('cobro',$cobro, 9999);
        $response = response("cookie creada");
        $response->withCookie($nueva_cookie);
        return \Request::cookie('cobro');
        */
        $nueva_cookie = cookie('cobro',$cobro, 9999);
        $response = response("cookie creada");
        $response->withCookie($nueva_cookie);
        dd($response);

    	$nombre_cobro = Cobro::findOrFail($cobro);
    	$data = array(
    				"cobro"=>$cobro,
    				"nombre_cobro"=>$nombre_cobro,
					"datos" =>null
				);
        return view('dashboard.home',compact('data'));
    }

}
