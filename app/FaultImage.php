<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaultImage extends Model
{
    //

    public function fault()
    {
        return $this->belongsTo('App\Fault');
    }
}
