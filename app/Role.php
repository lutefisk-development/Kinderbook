<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}