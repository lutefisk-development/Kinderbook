<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;

class Employee extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userDepartment()
    {
        return $this->hasOneThrough(Department::class, User::class);
    }
}
