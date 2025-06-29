<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  protected $fillable = [
        'item',
        'to',
        'date',
        'item_description',
        'paid_amount',
        'remarks',
    ];
}