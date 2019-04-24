<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'labs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'opening_time', 'closing_time', 'status', 'user_id', 'status_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function computers()
    {
        return $this->hasMany('App\Computer');
    }

    public function labReservations()
    {
        return $this->hasMany('App\LabReservation');
    }
    
}
