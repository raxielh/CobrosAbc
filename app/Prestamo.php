<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
	protected $table = 'prestamos';
	protected $fillable = ['interes','monto','fecha','tiempo','referencia','cliente_id','tipo_prestamo_id','cobro_id'];
}
