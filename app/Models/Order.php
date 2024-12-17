<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'od_transaction_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'od_product_id');
    }
}
