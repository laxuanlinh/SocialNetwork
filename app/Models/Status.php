<?php
namespace Link\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Status extends Model
{
    protected $table='statuses';

    protected $primaryKey='sid';

    protected $fillable = [
        'body'
    ];

    public function user()
    {
        return $this->belongsTo('Link\Models\User', 'uid');
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany('Link\Models\Status', 'parent_id')->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        return $this->hasMany('Link\Models\Like', 'sid');
    }
}