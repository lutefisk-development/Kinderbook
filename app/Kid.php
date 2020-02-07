<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Illness;
use App\Image;
use App\Message;
use App\User;

class Kid extends Model
{
    protected $fillable = [
        'department_id',
        'user_id',
        'first_name',
        'is_present',
        'last_name',
    ];

    /**
     * Relations to other models
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function illnesses()
    {
        return $this->hasMany(Illness::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
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
