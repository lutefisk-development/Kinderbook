<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kid;

class Message extends Model
{
    protected $fillable = [
        'kid_id',
        'content',
    ];

    /**
     * Relations to other models
     */
    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
