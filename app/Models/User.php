<?php

namespace Link\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Link\Models\Status;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use Authenticatable;

    protected $table='users';

    protected $primaryKey='uid';

    protected $fillable = [
        'username', 'email', 'password', 'firstname', 'lastname', 'location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName()
    {
        if($this->firstname && $this->lastname)
        {
            return "{$this->lastname} {$this->firstname} ";
        }
        if($this->firstname)
        {
            return $this->firstname;
        }
        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName()===null ? $this->username : $this->getName();
    }

    public function getFirstNameOrUsername()
    {
        return $this->firstname===null ? $this->username : $this->firstname;
    }

    public function getAvatarUrl()
    {
        return "https://gravatar.com/avatar/{{ md5 ($this->email)}}?d=mm&s=50";
    }

    public function getSmallAvatarUrl()
    {
        return "https://gravatar.com/avatar/{{ md5 ($this->email)}}?d=mm&s=30";
    }

    public function statuses()
    {
        return $this->hasMany('Link\Models\Status', 'uid');
    }

    public function likes()
    {
        return $this->hasMany('Link\Models\Like', 'uid');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('Link\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf()
    {
        return $this->belongsToMany('Link\Models\User', 'friends', 'friend_id', 'user_id');

    }

    public function friends()
    {
        $arr = $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
        return $arr;
    }

    //wtfff
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return $this->friendRequestPending()->where('uid', $user->uid)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return $this->friendRequests()->where('uid', $user->uid)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->uid);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('uid', $user->uid)->first()->pivot->
        update([
           'accepted'=>true,
        ]);
    }

    public function isFriendWith(User $user)
    {
        return (boolean) $this->friends()->where('uid', $user->uid)->count();
    }

    //check if user has already liked the status
    public function hasLikedStatus(Status $status)
    {
        if($status->likes
            ->where('likeable_id', $status->sid)
            ->where('likeable_type', get_class($status))
            ->where('uid', $this->uid)
            ->count()!==0)
        {
            return true;
        }
        return false;
    }

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->uid);
    }
}
