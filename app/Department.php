<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Announcement;

class Department extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
