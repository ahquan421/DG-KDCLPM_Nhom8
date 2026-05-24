<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details'; // đảm bảo đúng tên bảng

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    // ===== Relationships =====
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // ===== Helper Methods =====

    /**
     * Tính thành tiền (subtotal) của từng dòng đơn hàng
     */
    public function subtotal()
    {
        return $this->quantity * $this->price;
    }

    /**
     * Format giá tiền có đơn vị VNĐ
     */
    public function formattedSubtotal()
    {
        return number_format($this->subtotal(), 0, ',', '.') . ' ₫';
    }

    /**
     * Format giá sản phẩm
     */
    public function formattedPrice()
    {
        return number_format($this->price, 0, ',', '.') . ' ₫';
    }
}
