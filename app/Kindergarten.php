<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;

class Kindergarten extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
