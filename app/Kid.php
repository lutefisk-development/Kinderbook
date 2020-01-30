<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Illness;
use App\Message;
use App\Kindergarten;
use App\Image;
use App\Department;

class Kid extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function illnesses()
    {
        return $this->belongsToMany(Illness::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function userDepartment()
    {
        return $this->hasOneThrough(Department::class, User::class);
    }
}
