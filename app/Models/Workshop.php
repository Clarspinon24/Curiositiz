<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Workshop extends Model
{
    use HasFactory;

    protected $table = 'workshop';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participations(): HasMany
    {
        return $this->hasMany(Participation::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function getRating(): float|int
    {
        $rates = DB::table('rates')
            ->where('workshop_id', $this->id)
            ->where('status', 1)
            ->select('rate')
            ->get();

        $ratesCount = count($rates);

        if ($ratesCount > 0) {
            $ratings = 0;
            foreach ($rates as $rate) {
                $ratings += $rate->rate;
            }
            return round($ratings / $ratesCount, 2);
        }

        return -1;
    }

    public function getStatus(): string
    {
        return match ($this->status) {
            1       => config('constants.workshop_status.1'),
            2       => config('constants.workshop_status.2'),
            3       => config('constants.workshop_status.3'),
            4       => config('constants.workshop_status.4'),
            5       => config('constants.workshop_status.5'),
            default => '?',
        };
    }

    public function getOrganizationType(): string
    {
        return match ($this->org_type) {
            1       => config('constants.workshop_org_type.1'),
            2       => config('constants.workshop_org_type.2'),
            default => '?',
        };
    }
}
