<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
 public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
