<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
		protected $fillable = ['nombre', 'referencia','cobro_id'];
}
