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

    <!-- Nút quay lại -->
    <div class="mb-3">
        <a href="{{ session('back_book', route('user.dashboard')) }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>

    <h2 class="mb-4">Sản Phẩm bạn đã chọn </h2>

    <div class="card p-4 shadow-sm">
        <div class="row">
            <div class="col-md-4 text-center">
                <!-- Ảnh sách -->
                <img src="{{ asset($book->image) }}" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
            </div>

            <div class="col-md-8">
                <!-- Thông tin sách -->
                <h4>{{ $book->name }}</h4>
                <p><strong>Tác giả:</strong> {{ $book->author }}</p>
                <p><strong>Giá:</strong> <span class="text-primary" id="gia">{{ $book->price }}</span> ₫</p>
                <p><strong>Số lượng còn:</strong> {{ $book->quantity }}</p>

                <!-- Form Thanh toán -->
                <form method="POST" action="{{ route('user.checkout.process', $book->id) }}">
                    @csrf

                    <!-- Số lượng mua -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label"><strong>Số lượng muốn mua:</strong></label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $book->quantity }}" value="1" required>
                    </div>

                    <!-- Mã giảm giá -->
                    <div class="mb-3">
                        <label for="coupon" class="form-label"><strong>Mã giảm giá:</strong></label>
                        <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Nhập mã">
                    </div>

                    <!-- Giá gốc -->
                    <div class="mb-1">
                        <label class="form-label"><strong>Giá gốc:</strong></label>
                        <p class="text-decoration-line-through text-muted">
                            <span id="giaGoc"></span> ₫
                        </p>
                    </div>

                    <!-- Thành tiền -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Thành tiền:</strong></label>
                        <p class="fs-5"><span id="thanhTien"></span> ₫</p>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const gia = {{ $book->price }};
    const quantityInput = document.getElementById('quantity');
    const couponInput = document.getElementById('coupon');
    const thanhTienElement = document.getElementById('thanhTien');
    const giaGocElement = document.getElementById('giaGoc');

    function updateThanhTien() {
        const qty = parseInt(quantityInput.value) || 1;
        const originalTotal = gia * qty;
        let finalTotal = originalTotal;

        // Áp mã giảm giá
        if (couponInput.value.trim().toUpperCase() === 'COLIEN') {
            finalTotal = originalTotal * 0.9;
        }

        // Cập nhật HTML
        giaGocElement.textContent = originalTotal.toLocaleString();
        thanhTienElement.textContent = finalTotal.toLocaleString();
    }

    quantityInput.addEventListener('input', updateThanhTien);
    couponInput.addEventListener('input', updateThanhTien);
    window.addEventListener('DOMContentLoaded', updateThanhTien);
</script>
</x-app-layout>
