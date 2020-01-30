<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Image;

class Announcement extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

}
