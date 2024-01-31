<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['total', 'total_sum'];

    const APPENDS = ['title'];

    public function item()
    {
        return $this->belongsTo(Items::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Items::class, 'id', 'item_id');
    }

    public function getTotalAttribute()
    {
        return $this->item->price - $this->item->discount;
    }

    public function getTotalSumAttribute()
    {
        return $this->total * $this->quantity;
    }
}
