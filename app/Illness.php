<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kid;

class Illness extends Model
{
    //protected $fillable[];

    /**
     * Relations to other models
     */
    public function kids()
    {
        $this->belongsTo(Kid::class);
    }
}
