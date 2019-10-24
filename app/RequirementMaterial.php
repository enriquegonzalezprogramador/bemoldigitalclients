<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementMaterial extends Model
{
    protected $table = 'requirementmaterials';
    protected $fillable = ['project_id', 'warehouse_id', 'inventary_id', 'activity', 'quantity', 'price', 'deliveried', 'employee_id', 'observation', 'start_date', 'status'];

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function warehouse() {
        return $this->belongsTo('App\Warehouse');
    }

    public function inventary() {
        return $this->belongsTo('App\Inventary');
    }

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function total($cantidad, $precio) {
        return $cantidad * $precio;
     }

     public function calcularFaltante($cantidad, $entregado) {
        return $cantidad - $entregado;
     }

}
