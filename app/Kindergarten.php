<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use App\Employee;

class Kindergarten extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departments()
    {
        return $this->hasManyThrough(Department::class, User::class);
    }

    public function employees()
    {
        return $this->hasManyThrough(Employee::class, User::class);
    }
}
