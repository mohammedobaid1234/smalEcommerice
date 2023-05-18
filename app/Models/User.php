<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    public $append = ['image_url', 'product_cart', 'has_order'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:s a',
        'date_of_birth' => 'datetime',
    ];
    protected $hidden = ['password'];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function getImageUrlAttribute($value){
        if (!$this->image) {
            return asset('assets/images/avatars/avatar6.png');
        }
        if (stripos($this->image, 'http') ===  0) {
            return $this->image;
        }
        return asset('/storage/app/public/' . $this->image);
    }
    public function getHasOrderAttribute(){
        return Order::whereNull('checkout')->where('user_id', $this->id)->count() ?? 0;
    }
    public function getProductCartAttribute(){
        $order = Order::whereNull('checkout')->where('user_id', $this->id)->first();
        return $order->order_details->count() ?? 0;
    }
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
}
