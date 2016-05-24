<?php

namespace Link\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
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
}
