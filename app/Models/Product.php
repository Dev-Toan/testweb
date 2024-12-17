<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public $country = [
        1   =>  "Việt Nam",
        2   =>  "Anh",
        3   =>  "Thụy Sỹ",
        4   =>  "Mỹ"
    ];
    public function getCountry()
    {
        return Arr::get($this->country, $this->pro_country, "[N\A]");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'pro_category_id');
    }
    public function typeproduct()
    {
        return $this->belongsTo(TypeProduct::class, 'pro_type_product_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'ap_product_id', 'ap_attribute_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'img_product_id');
    }
    public function favourite()
    {
        return $this->belongsToMany(User::class, 'user_favourite', 'uf_product_id', 'uf_user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'r_product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'od_product_id');
    }
}
