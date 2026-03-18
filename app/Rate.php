<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function workshop()
	{
		return $this->belongsTo('App\Workshop');
	}

	public function getStatus()
	{
		if ($this->status === 1) {
			return config('constants.rate_status.1');
		} else if ($this->status === 2) {
			return config( 'constants.rate_status.2' );
		} else {
			return '?';
		}
	}
}
