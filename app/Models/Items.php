<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $appends = ['title', 'type', 'description', 'has_discount', 'discount_price', 'discount_percent', 'catalog_url'];

    public function catalog()
    {
        return $this->belongsTo(Catalogs::class, 'catalog_id', 'id');
    }

    public function getTypeAttribute()
    {
        return $this->catalog->name;
    }

    public function getHasDiscountAttribute()
    {
        return $this->discount > 0;
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

    public function getDescriptionAttribute()
    {
        return $this->country . ', ' . $this->size . ', ' . $this->material;
    }

    public function getCatalogUrlAttribute()
    {
        return $this->catalog->url;
    }
}
