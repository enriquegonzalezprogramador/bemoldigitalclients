<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obre extends Model
{
    protected $table = 'obres';
    protected $fillable = ['project_id', 'name', 'description', 'address', 'ubication', 'start_date', 'employee_id', 'status'];

public function Project() {
    return $this->belongsTo('App\Project');
}

public function Employee() {
    return $this->belongsTo('App\Employee');
}

public function outputmaterials() {
    return $this->hasMany('App\OutputMaterial');
}

public function beneficiarys() {
    return $this->hasMany('App\Beneficiary');
}

public function activitys() {
    return $this->hasMany('App\Obre');
}

}
