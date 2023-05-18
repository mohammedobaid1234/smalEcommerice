<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    use HasFactory;
    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a'];

    public function order_details(){
        return $this->hasMany(OrderDetails::class,'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
