<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    
     protected $fillable = [
        'name',
        'bank_name',
        'account_no',
        'ifsc_code',
        'sender_no',
        'date',
        'transcation_id',
        'bank_ref_no',
        'method',
        'status',
        'amount'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }






}
