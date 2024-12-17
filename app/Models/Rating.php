<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function product()
    {
        return $this->belongsTo(Product::class, 'r_product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'r_user_id');
    }
}
