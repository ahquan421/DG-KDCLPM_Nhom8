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
<div class="container mt-4">
    <div class="row">
        {{-- Cột trái: ảnh sách --}}
        <div class="col-md-4">
            <img src="{{ asset('images/' . $book->image) }}" 
                 class="img-fluid shadow rounded mb-3" 
                 alt="{{ $book->name }}" 
                 style="height: 350px; object-fit: cover;">
        </div>

        {{-- Cột phải: thông tin sách --}}
        <div class="col-md-8">
            <h2 class="mb-3 text-primary">{{ $book->name }}</h2>
            <p><strong>📚 Nhà xuất bản:</strong> {{ $book->publisher }}</p>
            <p><strong>✍️ Tác giả:</strong> {{ $book->author }}</p>
            <p><strong>🏷️ Thể loại (ID):</strong> {{ $book->category_id }}</p>

            <h4 class="text-danger mt-3">💰 {{ number_format($book->price) }} ₫</h4>
            <p><strong>📦 Số lượng còn:</strong> {{ $book->quantity }}</p>

            <div class="d-flex gap-3 mt-4">
                {{-- Nút mua ngay --}}
                <form action="{{ route('user.checkout.show', $book->id) }}" method="GET">
                    <button class="btn btn-danger btn-lg">🛒 Mua ngay</button>
                </form>

                {{-- Nút thêm vào giỏ hàng --}}
                <form method="POST" action="{{ route('user.cart.add', $book->id) }}">
                    @csrf
                    <button class="btn btn-warning btn-lg">➕ Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Thông tin chi tiết --}}
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="text-secondary">📘 Thông tin chi tiết</h4>
            <table class="table table-bordered mt-3">
                <tr><th>Tên sách</th><td>{{ $book->name }}</td></tr>
                <tr><th>Tác giả</th><td>{{ $book->author }}</td></tr>
                <tr><th>Nhà xuất bản</th><td>{{ $book->publisher }}</td></tr>
                <tr><th>Năm xuất bản</th><td>{{ $book->year_of_publication }}</td></tr>
                <tr><th>Giá bán</th><td>{{ number_format($book->price) }} ₫</td></tr>
                <tr><th>Số lượng còn lại</th><td>{{ $book->quantity }}</td></tr>
                <tr><th>Số trang</th><td>{{ $book->page }}</td></tr>
                <tr><th>Mô tả</th><td>{{ $book->description }}</td></tr>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
