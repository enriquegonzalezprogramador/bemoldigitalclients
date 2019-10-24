<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activitys';
    protected $fillable = ['project_id', 'obre_id', 'activity', 'employee_id', 'observation', 'start_date', 'status'];

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function obre() {
        return $this->belongsTo('App\Obre');
    }

    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
