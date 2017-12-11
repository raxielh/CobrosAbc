<?php

use App\Cobro;

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