<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabReservation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lab_reservations';

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
    protected $fillable = ['start_date', 'end_date', 'lab_id', 'status_id', 'reserved_by', 'reserved_at', 'description', 'reservable_id', 'reservable_type'];

    public function lab()
    {
        return $this->belongsTo('App\Lab');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function reserved_by()
    {
        return $this->belongsTo('App\User');
    }
    
}
