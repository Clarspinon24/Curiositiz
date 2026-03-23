<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workshop_id',
        'rate',
        'comment',
        'status',
    ];

    // Lien vers l'utilisateur qui a noté
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Lien vers l'atelier noté
    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class);
    }

    // Traduit le status en texte lisible
    public function getStatus(): string
    {
        return match ($this->status) {
            1       => config('constants.rate_status.1'),
            2       => config('constants.rate_status.2'),
            default => '?',
        };
    }

    // Vérifie si l'utilisateur a déjà noté ce workshop
    public static function alreadyRated(int $userId, int $workshopId): bool
    {
        return self::where('user_id', $userId)
                   ->where('workshop_id', $workshopId)
                   ->exists();
    }

    // Calcule la moyenne des notes d'un workshop
    public static function averageForWorkshop(int $workshopId): float
    {
        return self::where('workshop_id', $workshopId)
                   ->avg('rate') ?? 0;
    }
}