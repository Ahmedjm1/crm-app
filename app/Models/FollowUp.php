<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
   protected $fillable = [
    'user_id',
    'customer_id',
    'note',
    'reminder_date',
    'is_done'
];

public function customer()
{
    return $this->belongsTo(Customer::class);
}
}
