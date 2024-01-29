<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['total'];

    const APPENDS = ['title'];

    public function item()
    {
        return $this->belongsTo(Items::class);
    }

    public function items()
    {
        return $this->hasMany(Items::class, 'id', 'item_id');
    }

    public function getTotalAttribute()
    {
        return ($this->items->sum('price') - $this->items->sum('discount')) * $this->quantity;
    }
}
