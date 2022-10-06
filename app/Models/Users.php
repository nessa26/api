<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'lastname'
    ];

    public function orders()
    {
         return $this->hasMany(Order::class);
    }
}
