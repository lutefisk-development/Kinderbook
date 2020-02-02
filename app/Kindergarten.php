<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Kid;

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

    public function kids()
    {
        return $this->hasMany(Kid::class);
    }
}
