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
    protected $fillable = ['computer_id', 'status_id', 'logged_by', 'logged_at', 'description', 'actioned_by', 'actioned_at', 'parent_id'];

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
        return $this->belongsTo('App\User', 'logged_by', 'id');
    }
    public function actionedBy()
    {
        return $this->belongsTo('App\User', 'actioned_by', 'id');
    }
    
    public function parent()
    {
        return $this->belongsTo('App\Fault', 'parent_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany('App\Fault', 'parent_id', 'id');
    }

    public function faultImages()
    {
        return $this->hasMany('App\FaultImage');
    }
}
