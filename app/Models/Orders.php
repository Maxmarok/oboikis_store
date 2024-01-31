<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['order_sum', 'recieve'];

    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOrderSumAttribute()
    {
        return $this->order_items->sum('total_sum');
    }

    public function getRecieveAttribute()
    {
        return $this->delivery === 'ship' ? ($this->city . ', ' . $this->address) : 'Самовывоз';
    }
}
