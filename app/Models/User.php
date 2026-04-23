<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public const ROLES = [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'employee' => 'Employee',
        'customer' => 'Customer',
    ];

    public function getRoleLabel(): string
    {
        return self::ROLES[$this->type] ?? 'Unknown';
    }

    public function getIsSuperAdminAttribute(): bool
    {
        return $this->type === 'super_admin';
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'main');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
