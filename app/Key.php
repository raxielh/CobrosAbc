<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
	protected $table = 'key';
	protected $fillable = ['key','cobro_id'];
}
