<?php

namespace App;

use App\Notifications\PasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'phone', 'postal', 'city', 'slug', 'cgu', 'image_name', 'facebook_id', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new PasswordReset($token));
	}

    public function friendsOfMine()

    {

        return $this->belongsToMany('App\user', 'friendship', 'user_id', 'friend_id');

    }

    public function friendOf()

    {

        return $this->belongsToMany('App\user', 'friendship', 'friend_id', 'user_id');

    }


    //la fonction qui gere le pivot
    public function friends()

    {

        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->

        merge($this->friendOf()->wherePivot('accepted', true)->get());

    }


    //demande d'amis
    public function friendRequests()

    {

        return $this->friendsOfMine()->wherePivot('accepted', false)->get();

    }

    //demande d'amis en attente
    public function friendRequestsPending()

    {

        return $this->friendOf()->wherePivot('accepted', false)->get();

    }

    // comme demande d'amis en attente
    public function hasFriendRequestPending($user)

    {

        return (bool)$this->friendRequestsPending()->where('id', $user->id)->count();

    }

    // demande d'amis reçu
    public function hasFriendRequestReceived($user)

    {

        return (bool)$this->friendRequests()->where('id', $user->id)->count();

    }

    // Ajout ami
    public function addFriend($user)

    {

        $this->friendOf()->attach($user->id);

    }

    // Accept invitation

    public function acceptFriendRequest($user)

    {

        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([

            'accepted' => true,

        ]);

    }

    public function refuseFriendRequest($user)
    {

    }

    // Est ami avec

    public function isFriendsWith($user)

    {

        return (bool)$this->friends()->where('id', $user->id)->count();

    }


    /* Notifications */
    public function getNotificationsMessage($type)
    {
        if ($type == "App\Notifications\NewNetworkInvitation") {
            return "souhaite rejoindre votre réseau.";
        } else {
            return false;
        }
    }

    public function getNotificationsLink($type)
    {
        if ($type == "App\Notifications\NewNetworkInvitation") {
            return route('network.index');
        } else {
            return false;
        }


    }

    public function isAdmin()
    {
        return (bool)$this->admin;
    }

    public function cgu()
    {
        return (bool)$this->cgu;
    }


    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }


    public function avatar()
    {
        if (substr($this->image_name, 0, 4) === "http") {
            $imageLink = $this->image_name;
            return $imageLink;
        } else {
            $imageLink = asset('images/avatars/' . $this->image_name . '');
            return $imageLink;
        }
    }


    public function getFriendsIds()
    {

        $friendsIds = [];
        foreach ($this->friends() as $friend) {
            $friendsIds[] = $friend->id;
        }

        return $friendsIds;
    }

    public function workshop()
    {
        return $this->hasMany('App\Workshop');

    }

	public function participations()
	{
		return $this->hasMany('App\Participation');

	}

    public function workshop_participation()
    {
        return $this->belongsToMany('App\Workshop');
    }

	public function getRating()
	{
		$workshops = $this->workshop;
		$ratesCount = 0;
		$ratings = 0;
		foreach ($workshops as $workshop) {
			if ($workshop->getRating() != -1) {
				$ratings = $ratings + $workshop->getRating();
				$ratesCount = $ratesCount + 1;
			}
		}
		if ($ratesCount > 0) {
			$averageRatings = round($ratings / $ratesCount, 2);
		} else {
			$averageRatings = -1;
		}
		return $averageRatings;
	}
}
