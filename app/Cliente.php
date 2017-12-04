<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $fillable = ['nombre','identificacion','telefono','direccion','referencia','barrio_id','cobro_id'];
}
