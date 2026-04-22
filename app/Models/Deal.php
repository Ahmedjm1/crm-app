<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
    'user_id',
    'customer_id',
    'title',
    'status',
    'price'
];

public function customer()
{
    return $this->belongsTo(Customer::class);
}
}
