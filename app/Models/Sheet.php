<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sheet extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ageRange(): string|null
    {
        return match ($this->age_range) {
            1       => config('constants.age.0to3'),
            2       => config('constants.age.3to6'),
            3       => config('constants.age.6to12'),
            4       => config('constants.age.12to14'),
            5       => config('constants.age.0to99'),
            default => null,
        };
    }
}
