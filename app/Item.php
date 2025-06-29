<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = [
        'item_name',
        'price',
        'type',
        'category_id',
        'qty',
    ];
    
     public function category(){
        return $this->belongsTo('App\Category');
    }
    
}