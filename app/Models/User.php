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
        'usertype',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ===== Relationships =====

    // Mỗi user có thể có nhiều đơn hàng
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    // Mỗi user có thể có nhiều địa chỉ
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    // Mỗi user có thể có giỏ hàng
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    // ===== Helper methods =====

    /**
     * Kiểm tra user có phải admin không
     */
    public function isAdmin(): bool
    {
        return $this->usertype === 'admin';
    }

    /**
     * Lấy địa chỉ mặc định (nếu có)
     */
    public function defaultAddress()
    {
        return $this->addresses()->where('is_default', true)->first();
    }
}
