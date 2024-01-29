<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['order_sum'];

    public function order_items()
    {
        return $this->hasMany(Orders::class, 'id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOrderSumAttribute()
    {
        return $this->order_items->sum('total');
    }
}
