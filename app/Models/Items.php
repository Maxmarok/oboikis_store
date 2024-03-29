<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Items extends Model
{
    use HasFactory;

    protected $appends = ['title', 'type', 'description', 'has_discount', 'discount_price', 'discount_percent', 'catalog_url', 'image_url'];

    const SECTIONS = [
        'country' => 'Страна',
        'producer' => 'Производитель',
        'size' => 'Размер',
        'material' => 'Материал'
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalogs::class, 'catalog_id', 'id');
    }

    public function scopeItemsWithUrl(Builder $query, string $url): Builder
    {
        return $query->whereHas('catalog', function($q) use($url) {
            $q->where('url', $url);
        });
    }

    public function getLinkAttribute()
    {
        return route('catalog_item', ['section' => $this->catalog->url, 'id' => $this->id]);
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
        return $this->discount > 0 ? floor($this->discount / $this->price * 100) : 0;
    }

    public function getTitleAttribute()
    {
        //return "{$this->catalog->name} {$this->producer} {$this->name}";
        return $this->name;
    }

    public function getDescriptionAttribute()
    {
        $arr = array_filter([$this->country, $this->size, $this->material]);
        return implode(', ', $arr);
    }

    public function getCatalogUrlAttribute()
    {
        return $this->catalog->url;
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('images')->url($this->image) : null;
    }
}
