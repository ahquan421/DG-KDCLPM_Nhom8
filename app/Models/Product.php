<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'price', 
        'quantity', 
        'author', 
        'publisher', 
        'page', 
        'description', 
        'year_of_publication', 
        'image', 
        'slug', 
        'category_id'
    ];

    // Tạo slug khi tạo mới hoặc cập nhật
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

