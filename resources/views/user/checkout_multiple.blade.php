<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Thanh toán</title>

    <link rel="stylesheet"
          href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>

<body>

<x-app-layout>

<div class="product-wrapper">

    <!-- Nút quay lại -->
    <div class="back-box">
        <a href="{{ route('user.cart.index') }}"
           class="back-link">
            ← Quay lại giỏ hàng
        </a>
    </div>

    <h2 class="detail-title">
        💳 Sản phẩm bạn đã chọn
    </h2>

    <form method="POST"
          action="{{ route('user.checkout.multiple.process') }}">

        @csrf

        @php
            $tongTien = 0;
        @endphp

        @foreach ($books as $item)

        @php
            $thanhTien = $item['price'] * $item['quantity'];
            $tongTien += $thanhTien;
        @endphp

        <div class="product-card mb-4"
             style="margin-bottom:25px;">

            <!-- LEFT -->
            <div class="product-left">

                <div class="image-box">
                    <img src="{{ asset($item['image']) }}"
                         alt="{{ $item['name'] }}">
                </div>

            </div>

            <!-- RIGHT -->
            <div class="product-right">

                <h2 class="product-title">
                    {{ $item['name'] }}
                </h2>

                <div class="product-meta">

                    <p>
                        <strong>Giá:</strong>
                        {{ number_format($item['price']) }} ₫
                    </p>

                    <p>
                        <strong>Số lượng:</strong>
                        {{ $item['quantity'] }}
                    </p>

                </div>

                <div class="price-section">

                    <div class="price-new">
                        Thành tiền:
                        <span class="item-total">
                            {{ number_format($thanhTien) }}
                        </span> ₫
                    </div>

                </div>

                <!-- hidden gửi dữ liệu -->
                <input type="hidden"
                       name="selected_items[]"
                       value="{{ $item['id'] }}">

            </div>

        </div>

        @endforeach

        <!-- Coupon -->
        <div class="content-card">

            <div class="mb-3">
                <label>
                    <strong>Mã giảm giá:</strong>
                </label>

                <input type="text"
                       id="coupon"
                       name="coupon"
                       class="qty-input"
                       style="width:100%;height:55px;"
                       placeholder="Nhập mã giảm giá">
            </div>

            <div style="margin-top:20px;">

                <p class="price-old">
                    Giá gốc:
                    <span id="giaGoc">
                        {{ number_format($tongTien) }}
                    </span> ₫
                </p>

                <div class="price-new">
                    Tổng tiền:
                    <span id="tongTien">
                        {{ number_format($tongTien) }}
                    </span> ₫
                </div>

            </div>

            <button type="submit"
                    class="buy-btn"
                    style="margin-top:20px; width:100%; height:60px;">

                🛒 Đặt hàng

            </button>

        </div>

    </form>

</div>

<script>

    const originalPrice = {{ $tongTien }};

    const couponInput =
        document.getElementById('coupon');

    const tongTien =
        document.getElementById('tongTien');

    const giaGoc =
        document.getElementById('giaGoc');

    function updatePrice() {

        let finalPrice = originalPrice;

        // mã COLIEN giảm 10%
        if (
            couponInput.value
            .trim()
            .toUpperCase() === 'COLIEN'
        ) {
            finalPrice =
                originalPrice * 0.9;
        }

        giaGoc.innerText =
            originalPrice.toLocaleString();

        tongTien.innerText =
            Math.floor(finalPrice)
            .toLocaleString();
    }

    couponInput
        .addEventListener(
            'input',
            updatePrice
        );

    window.addEventListener(
        'DOMContentLoaded',
        updatePrice
    );

</script>

</x-app-layout>

</body>
</html>