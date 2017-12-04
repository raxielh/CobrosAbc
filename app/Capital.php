<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
	protected $table = 'capital';
	protected $fillable = ['monto', 'referencia','cobro_id'];
}
