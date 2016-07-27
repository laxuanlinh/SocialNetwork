<?php
namespace Link\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'nid';

    protected $fillable= [
        'body', 'type'
    ];

    public function Notification()
    {
        return $this->morphTo();
    }
}