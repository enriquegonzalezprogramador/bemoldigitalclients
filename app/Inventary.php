<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    protected $table = 'inventarys';
    protected $fillable = ['warehouse_id', 'description', 'provider', 'category', 'quantity', 'price', 'observation'];

    public function warehouse() {
       return $this->belongsTo('App\Warehouse');
    }

    public function total($cantidad, $precio) {
        return $cantidad * $precio;
     }

     public function sumar($cantidad, $valor) {
      return $cantidad + $valor;
   }

   public function restar($cantidad, $valor) {
      return $cantidad - $valor;
   }

   public function inputmaterials(){
         return $this->hasMany('App\InputMaterial');
   }

   public function requirementsmaterial() {
      return $this->hasMany('App\RequirementMaterial');
  }
}
