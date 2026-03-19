<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ageRange()
    {
        if ($this->age_range === 1) {
            return config('constants.age.0to3');
        }
        if ($this->age_range === 2) {
            return config('constants.age.3to6');
        }
        if ($this->age_range === 3) {
            return config('constants.age.6to12');
        }
        if ($this->age_range === 4) {
            return config('constants.age.12to14');
        }
        if ($this->age_range === 5) {
            return config('constants.age.0to99');
        }
    }
}
