<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable=[
        'total',
        'reference',
        'subtotal',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function orderProduct()
    {
       return $this->belongsTo(orderProduct::class);
    }
}
