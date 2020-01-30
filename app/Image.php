<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kid;
use App\Announcement;

class Image extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function kid()
    {
        return $this->hasOne(Kid::class);
    }

    public function announcement()
    {
        return $this->hasOne(Announcement::class);
    }
}
