<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Announcement;
use App\Kid;
use App\Kindergarten;

class Department extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function kids()
    {
        return $this->hasMany(Kid::class);
    }

    public function kindergarten()
    {
        return $this->belongsTo(Kindergarten::class);
    }
}
