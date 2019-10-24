<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputMaterial extends Model
{
    protected $table = 'outputmaterials';
    protected $fillable = ['project_id', 'obre_id', 'warehouse_id', 'inventary_id', 'quantity', 'price', 'employee_id', 'observation', 'start_date', 'status'];

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function obre() {
        return $this->belongsTo('App\Obre');
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

    }
