<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoPrestamo extends Model
{
	protected $table = 'pago_prestamos';
	protected $fillable = ['monto','fecha','referencia','prestamo_id','cobro_id','user_id'];
}
