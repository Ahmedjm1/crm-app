<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'phone',
    'notes'
];
public function deals()
{
    return $this->hasMany(Deal::class);
}
public function followUps()
{
    return $this->hasMany(FollowUp::class);
}
}
