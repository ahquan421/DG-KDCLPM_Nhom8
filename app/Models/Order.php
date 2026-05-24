<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // 👈 thêm rõ để tránh nhầm nếu table có tiền tố

    protected $fillable = [
        'order_date',
        'status',
        'total_money',
        'customer_id',
        'address_id',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_money' => 'decimal:2',
    ];

    // ===== Relationships =====
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // ===== Helper methods =====

    /** 
     * Tổng số lượng sản phẩm trong đơn hàng 
     */
    public function totalItems()
    {
        return $this->orderDetails->sum('quantity');
    }

    /** 
     * Kiểm tra đơn đã hoàn tất hay chưa 
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /** 
     * Format tổng tiền dễ đọc 
     */
    public function formattedTotal()
    {
        return number_format($this->total_money, 0, ',', '.') . ' ₫';
    }
}
