<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kid;

class Message extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function kid()
    {
        return $this->hasMany(Kid::class);
    }
}
