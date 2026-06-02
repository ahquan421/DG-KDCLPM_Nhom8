<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'date',
        'status',
        'total_money',
        'customer_id',
        'address_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'total_money' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(
            User::class,
            'customer_id'
        );
    }

    public function address()
    {
        return $this->belongsTo(
            Address::class,
            'address_id'
        );
    }

    public function orderDetails()
    {
        return $this->hasMany(
            OrderDetail::class,
            'order_id'
        );
    }

    // ==========================
    // HELPER METHODS
    // ==========================

    public function totalItems()
    {
        return $this->orderDetails
            ->sum('quantity');
    }

    public function isCompleted()
    {
        return $this->status
            === 'completed';
    }

    public function formattedTotal()
    {
        return number_format(
            $this->total_money,
            0,
            ',',
            '.'
        ) . ' ₫';
    }
}