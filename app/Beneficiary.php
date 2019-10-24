<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $table = 'beneficiarys';
    protected $fillable = ['obre_id', 'dni', 'first_name', 'second_name', 'last_name', 'phone', 'email'];


    public function obre() {
        belongsTo('App\Obre');
    }
}
