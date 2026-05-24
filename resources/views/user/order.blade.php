<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Online Bookstore</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<x-app-layout>
<div class="container py-4">
    <h2 class="mb-4">Lịch sử mua sách của bạn</h2>

    @forelse ($orders as $order)
        <div class="card mb-4 shadow-sm border-0">
            <div class="row g-0">
                <div class="col-md-3">
                    <img src="{{ asset($order->product->image) }}" alt="Ảnh sách" 
                         class="img-fluid rounded-start" 
                         style="object-fit: cover; height: 100%;">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">{{ $order->product->name }}</h5>
                        <p class="mb-1"><strong>Tác giả:</strong> {{ $order->product->author }}</p>
                        <p class="mb-1"><strong>Nhà xuất bản:</strong> {{ $order->product->publisher }}</p>
                        <p class="mb-1"><strong>Số lượng mua:</strong> {{ $order->quantity }}</p>
                        <p class="mb-1"><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }}đ</p>
                        <p class="mb-3 text-muted"><strong>Thời gian:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        
                        <a href="{{ route('user.products.show', $order->product->id) }}" class="btn btn-outline-primary">
                            📖 Mua lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Bạn chưa có đơn hàng nào.</p>
    @endforelse
</div>

</x-app-layout>
