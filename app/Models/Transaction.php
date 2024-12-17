<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [''];

    protected $status = [
        '1' => [
            'class' => 'default',
            'name' => 'Vừa Tiếp Nhận',
        ],
        '2' => [
            'class' => 'info',
            'name' => 'Đang Vận Chuyển',
        ],
        '3' => [
            'class' => 'success',
            'name' => 'Đã Bàn Giao',
        ],
        '-1' => [
            'class' => 'danger',
            'name' => 'Đã Hủy',
        ],
    ];
    public function getStatus()
    {
        return Arr::get($this->status, $this->tst_status, "[N\A]");
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'od_transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'tst_user_id');
    }
}
