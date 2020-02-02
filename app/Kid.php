<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Illness;
use App\Image;
use App\Kindergarten;
use App\Message;
use App\User;

class Kid extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function illnesses()
    {
        return $this->hasMany(Illness::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function kindergarten()
    {
        return $this->belongsTo(Kindergarten::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
