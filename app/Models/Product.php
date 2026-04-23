<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const GENDERS = [
        'men'   => 'Men',
        'women' => 'Women',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'main');
    }

    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery')->latest();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getImgPathAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image->path);
        }
        return 'https://via.placeholder.com/100x80';
    }
}
