<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SalesEntry extends Model
{

    protected $fillable = [
        'sale_date', 'customer_id', 'item_id', 'category_id', 'width', 'height', 'sq_ft',
        'qty', 'price', 'total', 'remarks', 'discount', 'final_amount', 'paid_amount', 'remain_amount'
    ];
    
    
     public function customer(){
        return $this->belongsTo('App\Customer');
    }
    
    
}