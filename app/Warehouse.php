<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable=['project_id','name','address', 'city', 'phone', 'employee_id'];

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function inventary() {
       return  $this->hasOne('App\Inventary');
    }

    public function inputmaterials(){
        return $this->hasMany('App\InputMaterial');
  }

  public function requirementsmaterial() {
    return $this->hasMany('App\RequirementMaterial');
}
}
