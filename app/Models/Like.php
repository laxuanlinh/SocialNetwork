<?php
namespace Link\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='likeable';

    protected $primaryKey='likeable_id';

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Link\Models\User', 'uid');
    }
}