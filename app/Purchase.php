<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

     protected $fillable = [
        'invoice_no',
        'purchase_date',
        'party_id',
        'item_id',
        'category_id',
        'purchase_price',
        'qty',
        'total',
        'remarks',
        'final_amount',
        'paid_amount',
        'remain_amount',
    ];

    protected $dates = [
        'purchase_date',
    ];
    
     // Relationships
    public function party()
    {
        return $this->belongsTo(Customer::class, 'party_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    
    
}