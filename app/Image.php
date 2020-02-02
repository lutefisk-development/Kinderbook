<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Announcement;
use App\Kid;

class Image extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
