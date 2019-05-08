<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentRequest extends Model
{
    public function games(){
    	return $this->belongsToMany("\App\Game")->withPivot("quantity")->withPivot("week")->withTimestamps();
    }
}