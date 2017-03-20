<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{

	protected $guarded = ['id'];

	public function albums()
	{
		return $this->hasMany('App\Album');
	}

}
