<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $type = [
        1   => [
            'name'  => 'Năng Lượng',
            'class' => 'label label-default'
        ],
        2   => [
            'name'  => 'Loại Dây',
            'class' => 'label label-danger'
        ],
        3   => [
            'name'  => 'Đường Kính Mặt',
            'class' => 'label label-success'
        ]
    ];

    public function getType()
    {
        return Arr::get($this->type, $this->atb_type, '[N\A]');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'atb_category_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_product', 'ap_attribute_id', 'ap_product_id');
    }
}
