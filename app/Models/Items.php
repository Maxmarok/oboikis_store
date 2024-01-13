<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $appends = ['title', 'discount_price', 'discount_percent'];

    public function catalog()
    {
        return $this->belongsTo(Catalogs::class, 'catalog_id', 'id');
    }

    public function getDiscountPriceAttribute()
    {
        return $this->price - $this->discount;
    }

    public function getDiscountPercentAttribute()
    {
        return $this->discount > 0 ? round($this->discount / $this->price * 100, 0) : 0;
    }

    public function getTitleAttribute()
    {
        return $this->catalog->name . ' ' . $this->producer . ' ' . $this->name;
    }
}
