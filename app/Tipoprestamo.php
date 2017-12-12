<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoprestamo extends Model
{
	protected $table = 'tipo_prestamos';
	protected $fillable = ['nombre', 'referencia'];
}
