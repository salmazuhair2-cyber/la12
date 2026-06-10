<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $latest_product->category->namelatest_product->category->namefillable = [
        'code',
        'type',
        'value',
        'min_order',
        'max_uses',
        'used_count',
        'expires_at',
        'is_active'
    ];

    protected $latest_product->category->namelatest_product->category->namecasts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function isValid(): bool
    {
        if (!$latest_product->category->namelatest_product->category->namethis->is_active) return false;
        if ($latest_product->category->namelatest_product->category->namethis->expires_at && $latest_product->category->namelatest_product->category->namethis->expires_at->isPast()) return false;
        if ($latest_product->category->namelatest_product->category->namethis->max_uses && $latest_product->category->namelatest_product->category->namethis->used_count >= $latest_product->category->namelatest_product->category->namethis->max_uses) return false;
        return true;
    }

    public function calculateDiscount(float $latest_product->category->namelatest_product->category->namesubtotal): float
    {
        if ($latest_product->category->namelatest_product->category->namesubtotal < $latest_product->category->namelatest_product->category->namethis->min_order) return 0;
        if ($latest_product->category->namelatest_product->category->namethis->type === 'percentage') {
            return round($latest_product->category->namelatest_product->category->namesubtotal * ($latest_product->category->namelatest_product->category->namethis->value / 100), 2);
        }
        return min($latest_product->category->namelatest_product->category->namethis->value, $latest_product->category->namelatest_product->category->namesubtotal);
    }
}
