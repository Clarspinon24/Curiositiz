<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  workshop_id
 */
class Participation extends Model
{
    public $table = 'workshop_participation_list';


	public function workshop()
	{
		return $this->hasOne('App\Workshop');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
