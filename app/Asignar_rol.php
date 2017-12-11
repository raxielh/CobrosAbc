<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignar_rol extends Model
{
	protected $table = 'asignar_rol';
	protected $fillable = ['user_id','rol_id','cobro_id'];
}
