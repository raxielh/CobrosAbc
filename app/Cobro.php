<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
	protected $fillable = ['nombre', 'localidad','estado','color','user_id'];
}
