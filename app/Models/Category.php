<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [''];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'c_parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'c_parent_id');
    }
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    public function typeproducts()
    {
        return $this->hasmany(TypeProduct::class, 'tp_category_id');
    }
    public function attributes()
    {
        return $this->hasmany(Attribute::class, 'atb_category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'pro_category_id');
    }
}
