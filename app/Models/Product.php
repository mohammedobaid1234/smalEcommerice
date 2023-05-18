<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes;
    public $appends = ['image_url'];
    protected $table = 'products';

    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s a'];


    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/placeholder.png');
        }

        if (stripos($this->image, 'http') === 0) {
            return $this->image;
        }

        return asset('uploads/' . $this->image);
    }

}
