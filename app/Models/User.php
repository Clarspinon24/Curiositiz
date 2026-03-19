<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname',
        'phone', 'postal', 'city', 'slug', 'cgu',
        'image_name', 'facebook_id', 'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * Send the password reset notification.
     * Signature must match parent without return type hint.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($token));
    }

    public function friendsOfMine(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendship', 'user_id', 'friend_id');
    }

    public function friendOf(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friendship', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user): bool
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user): bool
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user): void
    {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user): void
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function refuseFriendRequest(User $user): void
    {
        $this->friendsOfMine()->detach($user->id);
        $this->friendOf()->detach($user->id);
    }

    public function isFriendsWith(User $user): bool
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function getNotificationsMessage(string $type): string|false
    {
        return match ($type) {
            'App\Notifications\NewNetworkInvitation' => 'souhaite rejoindre votre réseau.',
            default => false,
        };
    }

    public function getNotificationsLink(string $type): string|false
    {
        return match ($type) {
            'App\Notifications\NewNetworkInvitation' => route('network.index'),
            default => false,
        };
    }

    public function isAdmin(): bool
    {
        return (bool) $this->admin;
    }

    public function hasCgu(): bool
    {
        return (bool) $this->cgu;
    }

    public function verifyUser(): HasOne
    {
        return $this->hasOne(VerifyUser::class);
    }

    public function avatar(): string
    {
        if (str_starts_with($this->image_name, 'http')) {
            return $this->image_name;
        }

        return asset('images/avatars/' . $this->image_name);
    }

    public function getFriendsIds(): array
    {
        $friendsIds = [];
        foreach ($this->friends() as $friend) {
            $friendsIds[] = $friend->id;
        }

        return $friendsIds;
    }

    public function workshop(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }

    public function participations(): HasMany
    {
        return $this->hasMany(Participation::class);
    }

    public function workshop_participation(): BelongsToMany
    {
        return $this->belongsToMany(Workshop::class);
    }

    public function getRating(): float|int
    {
        $workshops = $this->workshop;
        $ratesCount = 0;
        $ratings = 0;

        foreach ($workshops as $workshop) {
            if ($workshop->getRating() !== -1) {
                $ratings += $workshop->getRating();
                $ratesCount++;
            }
        }

        return $ratesCount > 0 ? round($ratings / $ratesCount, 2) : -1;
    }
}
