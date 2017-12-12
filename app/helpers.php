<?php

use App\Cobro;
use App\Cobrador;
use Illuminate\Support\Facades\DB;

function currentUser()
{
	$id=auth()->user()->id;
    $cobro= Cobro::all()->where('user_id',$id);
    $c=count($cobro);

    if($c>0){
    	return true;
    }else{
    	return false;
    }
    
}

function esadmin()
{
/*	$id=auth()->user()->id;
    $admin=DB::table('users')
                ->selectRaw('*')
                ->where('admin',1)
                ->get();
    return count($admin);
*/
return  1;   
}