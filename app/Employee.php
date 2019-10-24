<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['dni', 'first_name', 'second_name', 'last_name', 'phone', 'email', 'salary', 'start_date','position', 'status'];

    public function project() {
        return $this->hasOne('App\Project');
     }

    public function warehouse() {
       return $this->hasOne('App\Warehouse');
    }

    public function inputmaterials() {
        return $this->hasMany('App\InputMaterial');
    }

    public function requirementsmaterial() {
        return $this->hasMany('App\RequirementMaterial');
    }

    public function activitys() {
        return $this->hasMany('App\Obre');
    }
}
