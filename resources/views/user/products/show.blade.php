@extends('layouts.user')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Online Bookstore</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container mt-4">

    {{-- ===== Link quay lại (mới) ===== --}}
    <div class="mb-3">
        <a href="{{ url('/user/dashboard') }}" class="back-link">← Back</a>
    </div>

    {{-- ===== Khu vực chi tiết sản phẩm ===== --}}
    <div class="product-detail row">
        <div class="col-md-5">
            <img src="{{ asset($book->image) }}"
                 class="img-fluid shadow rounded mb-3"
                 alt="{{ $book->name }}"
                 style="height: 350px; object-fit: cover;">
        </div>

        {{-- Cột phải: Thông tin sách (giữ mới + phục hồi các dòng đã xoá) --}}
        <div class="col-md-7 product-info">

            <h1 class="mb-3 text-primary">{{ $book->name }}</h1>
            <p><strong>🏢 Nhà xuất bản:</strong> {{ $book->publisher }}</p>
            <p><strong>✍️ Tác giả:</strong> {{ $book->author }}</p>
            <p><strong>🏷️ Thể loại (ID):</strong> {{ $book->category_id }}</p>

            {{-- Giá (giữ block giá mới) --}}
            <div class="price-box mt-3">
                <span class="price-old">{{ number_format($book->price + 50000) }} VNĐ</span>
                <span class="price-new">{{ number_format($book->price) }} VNĐ</span>
            </div>

            {{-- Số lượng còn (phục hồi) + các chi tiết ngắn (mới) --}}
            <h4 class="text-danger mt-3">Còn lại: {{ $book->quantity }} cuốn</h4>

            <div class="detail-list mt-3">
                <p><span class="detail-label">Nhà xuất bản:</span> {{ $book->publisher }}</p>
                <p><span class="detail-label">Thể loại:</span> {{ $book->category_id }}</p>
                <p><span class="detail-label">Số lượng còn:</span> {{ $book->quantity }}</p>
                <p><span class="detail-label">Số trang:</span> {{ $book->page }}</p>
            </div>

            {{-- Nút mua & thêm giỏ (GIỮ MỚI) --}}
            <div class="d-flex gap-3 mt-4">
                <form action="{{ route('user.checkout.show', $book->id) }}" method="GET" class="d-flex align-items-center gap-2">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $book->quantity }}" class="form-control" style="width: 80px;">
                    <button class="btn btn-red">Mua ngay</button>
                </form>

                <form method="POST" action="{{ route('user.cart.add', $book->id) }}" class="d-flex align-items-center gap-2">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" max="{{ $book->quantity }}" class="form-control" style="width: 80px;">
                    <button type="submit" class="btn btn-yellow">Thêm vào giỏ hàng</button>
                    <a href="{{ route('user.cart.index') }}" class="btn btn-outline-primary">🛒 Xem giỏ hàng</a>
                </form>
            </div>

            {{-- Shipping box (GIỮ MỚI) --}}
            <div class="shipping-box mt-4">
                <p><span>✔</span> Free Xpress Shipping on orders over 149.000 ₫</p>
                <p><span>✔</span> Order before 12:00pm for same day dispatch</p>
                <p><span>✔</span> Support & ordering 7 days a week</p>
            </div>
        </div>
    </div>

    {{-- Tabs + mô tả (GIỮ MỚI) --}}
    <div class="tabs mt-5">
        <button class="active">Mô tả</button>
        <button>Đánh giá</button>
        <button>Giới thiệu bạn bè</button>
    </div>
    <div class="desc mt-3">
        {!! $book->description !!}
    </div>

    {{-- BẢNG “Thông tin chi tiết” (PHỤC HỒI) --}}
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="text-secondary">📘 Thông tin chi tiết</h4>
            <table class="table table-bordered mt-3">
                <tr><th>Tên sách</th><td>{{ $book->name }}</td></tr>
                <tr><th>Tác giả</th><td>{{ $book->author }}</td></tr>
                <tr><th>Nhà xuất bản</th><td>{{ $book->publisher }}</td></tr>
                <tr><th>Năm xuất bản</th><td>{{ $book->year_of_publication }}</td></tr>
                <tr><th>Giá bán</th><td>{{ number_format($book->price) }} đ</td></tr>
                <tr><th>Số lượng còn lại</th><td>{{ $book->quantity }}</td></tr>
                <tr><th>Số trang</th><td>{{ $book->page }}</td></tr>
                <tr><th>Mô tả</th><td>{!! $book->description !!}</td></tr>
            </table>
        </div>
    </div>

</div>
</body>
</html>
