<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComputerReservation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'computer_reservations';

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
    protected $fillable = ['start_date', 'end_date', 'computer_id', 'status_id', 'reserved_by', 'reserved_at', 'description'];

    // public function lab()
    // {
    //     return $this->belongsTo('App\Lab');
    // }
    public function computer()
    {
        return $this->belongsTo('App\Computer');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function reservedBy()
    {
        return $this->belongsTo('App\User', 'reserved_by', 'id');
    }
    
}
