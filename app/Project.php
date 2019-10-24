<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table  ="projects";
    protected $fillable = ['name', 'description', 'address', 'ubication', 'phone', 'email', 'start_date', 'employee_id', 'status'];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function warehouses() {
        return $this->hasMany('App\Warehouse');
    }

    public function obres() {
        return $this->hasMany('App\Obre');
    }

    public function requirementsmaterial() {
        return $this->hasMany('App\RequirementMaterial');
    }

    public function activitys() {
        return $this->hasMany('App\Obre');
    }
}
