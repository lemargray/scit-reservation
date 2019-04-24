<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'computers';

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
    protected $fillable = ['name', 'description', 'lab_id', 'status_id', 'status_id'];

    public function lab()
    {
        return $this->belongsTo('App\Lab');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function computerReservations()
    {
        return $this->hasMany('App\ComputerReservation');
    }
    
}
