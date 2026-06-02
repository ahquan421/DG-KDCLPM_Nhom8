<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Readora - Thanh toán</title>

    <link rel="stylesheet"
        href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>

<body>

    <x-app-layout>

        <div class="product-wrapper">

            <!-- quay lại -->
            <div class="back-box">
                <a href="{{ route('user.cart.index') }}"
                    class="back-link">

                    ← Quay lại giỏ hàng

                </a>
            </div>

            <!-- địa chỉ -->
            <div class="content-card mb-4">

                <h2 class="checkout-heading">
                    📍 Địa Chỉ Nhận Hàng
                </h2>

                <div class="address-content">

                    <strong>
                        {{ Auth::user()->name ?? 'Người dùng' }}
                    </strong>

                    <div style="margin-top:15px;">

                        <input type="text"
                            name="phone"
                            form="checkoutForm"
                            class="checkout-input"
                            placeholder="Nhập số điện thoại"
                            required>

                    </div>

                    <div style="margin-top:15px;">

                        <textarea
                            name="address"
                            form="checkoutForm"
                            class="checkout-input"
                            placeholder="Nhập địa chỉ nhận hàng"
                            required></textarea>

                    </div>

                </div>

            </div>

            <form method="POST"
                id="checkoutForm"
                action="{{ route('user.checkout.multiple.process') }}">

                @csrf

                @php
                $tongTien = 0;
                @endphp

                <!-- danh sách sản phẩm -->
                <div class="content-card mb-4">

                    <div class="checkout-table-header">

                        <span>Sản phẩm</span>
                        <span>Đơn giá</span>
                        <span>Số lượng</span>
                        <span>Thành tiền</span>

                    </div>

                    @foreach ($books as $item)

                    @php
                    $thanhTien =
                    $item['price'] *
                    $item['quantity'];

                    $tongTien += $thanhTien;
                    @endphp

                    <div class="checkout-product">

                        <!-- product -->
                        <div class="product-info">

                            <img src="{{ asset($item['image']) }}"
                                class="checkout-image"
                                alt="{{ $item['name'] }}">

                            <div>

                                <h4>
                                    {{ $item['name'] }}
                                </h4>

                                <p>
                                    Tác giả:
                                    {{ $item['author'] ?? 'Chưa cập nhật' }}
                                </p>

                            </div>

                        </div>

                        <!-- price -->
                        <div class="price-box">

                            {{ number_format($item['price']) }} ₫

                        </div>

                        <!-- quantity -->
                        <div>

                            {{ $item['quantity'] }}

                        </div>

                        <!-- total -->
                        <div class="final-price">

                            {{ number_format($thanhTien) }} ₫

                        </div>

                        <!-- hidden -->
                        <input type="hidden"
                            name="selected_items[]"
                            value="{{ $item['id'] }}">

                    </div>

                    @endforeach

                </div>

                <!-- lời nhắn + vận chuyển -->
                <div class="content-card mb-4">

                    <div class="checkout-flex">

                        <div class="checkout-left">

                            <label>
                                <strong>
                                    Lời nhắn
                                </strong>
                            </label>

                            <textarea
                                class="checkout-input"
                                placeholder="Lưu ý cho người bán..."></textarea>

                        </div>

                        <div class="checkout-right">

                            <h4>
                                🚚 Phương thức vận chuyển
                            </h4>

                            <p>
                                Giao hàng nhanh
                            </p>

                            <small>
                                Nhận hàng dự kiến
                                2-4 ngày
                            </small>

                        </div>

                    </div>

                </div>

                <!-- voucher + tổng -->
                <div class="content-card">

                    <div class="mb-4">

                        <label>
                            <strong>
                                Mã giảm giá
                            </strong>
                        </label>

                        <input type="text"
                            id="coupon"
                            name="coupon"
                            class="qty-input"
                            placeholder="Nhập mã giảm giá">

                    </div>

                    <div class="checkout-summary">

                        <p>

                            Giá gốc:

                            <strong>

                                <span id="giaGoc">
                                    {{ number_format($tongTien) }}
                                </span>

                                ₫

                            </strong>

                        </p>

                        <p>

                            Tổng tiền:

                            <strong>

                                <span id="tongTien">
                                    {{ number_format($tongTien) }}
                                </span>

                                ₫

                            </strong>

                        </p>

                    </div>

                    <button type="submit"
                        class="buy-btn"
                        style="margin-top:20px;">

                        Đặt hàng

                    </button>

                </div>

            </form>

        </div>

        <script>
            const originalPrice = {
                {
                    $tongTien
                }
            };

            const couponInput =
                document.getElementById('coupon');

            const tongTien =
                document.getElementById('tongTien');

            const giaGoc =
                document.getElementById('giaGoc');

            function updatePrice() {

                let finalPrice =
                    originalPrice;

                // giảm 10%
                if (
                    couponInput.value
                    .trim()
                    .toUpperCase() === 'COLIEN'
                ) {

                    finalPrice =
                        originalPrice * 0.9;
                }

                giaGoc.innerText =
                    originalPrice
                    .toLocaleString('vi-VN');

                tongTien.innerText =
                    Math.floor(finalPrice)
                    .toLocaleString('vi-VN');
            }

            couponInput.addEventListener(
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