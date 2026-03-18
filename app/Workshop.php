<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Workshop extends Model
{
    public $table = 'workshop';

    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function participations()
	{
		return $this->hasMany('App\Participation');
	}

	public function rates()
	{
		return $this->hasMany('App\Rate');
	}

	public function getRating()
	{
		$rates = DB::table('rates')
			->where('workshop_id', $this->id)
			->where('status', 1)
			->select('rate')
			->get()
		;
		$ratesCount = count($rates);
		if ($ratesCount > 0) {
			$ratings = 0;
			foreach ($rates as $rate) {
				$ratings = $ratings + $rate->rate;
			}
			$averageRatings = round($ratings / $ratesCount, 2);
		} else {
			$averageRatings = -1;
		}
		return $averageRatings;
	}

	public function getStatus()
	{
		if ($this->status === 1) {
			return config('constants.workshop_status.1');
		} else if ($this->status === 2) {
			return config( 'constants.workshop_status.2' );
		} else if ($this->status === 3) {
			return config( 'constants.workshop_status.3' );
		} else if ($this->status === 4) {
			return config( 'constants.workshop_status.4' );
		} else if ($this->status === 5) {
			return config( 'constants.workshop_status.5' );
		} else {
			return '?';
		}
	}

	public function getOrganizationType()
	{
		if ($this->org_type == 1) {
			return config('constants.workshop_org_type.1');
		} else if ($this->org_type == 2) {
			return config( 'constants.workshop_org_type.2' );
		} else {
			return '?';
		}
	}
}
