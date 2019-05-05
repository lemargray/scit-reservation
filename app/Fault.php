<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fault extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faults';

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
    protected $fillable = ['computer_id', 'status_id', 'logged_by', 'logged_at', 'description', 'actioned_by', 'actioned_at'];

    public function computer()
    {
        return $this->belongsTo('App\Computer');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function loggedBy()
    {
        return $this->belongsTo('App\User');
    }
    public function actionedBy()
    {
        return $this->belongsTo('App\User');
    }
    
}
