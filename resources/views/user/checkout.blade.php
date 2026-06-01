<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Checkout</title>

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

            <!-- Địa chỉ -->
            <div class="content-card mb-4">

                <h2 class="checkout-heading">
                    📍 Địa Chỉ Nhận Hàng
                </h2>

                <div class="address-content">

                    <strong>
                        {{ Auth::user()->name ?? 'Người dùng' }}
                    </strong>

                    <p>
                        Địa chỉ chưa cập nhật
                    </p>

                </div>

            </div>

            <form method="POST"
                action="{{ route('user.checkout.process', $book->id) }}">

                @csrf

                <input type="hidden"
                    name="quantity"
                    id="hiddenQuantity"
                    value="1">

                <!-- Sản phẩm -->
                <div class="content-card mb-4">

                    <div class="checkout-table-header">

                        <span>Sản phẩm</span>
                        <span>Đơn giá</span>
                        <span>Số lượng</span>
                        <span>Thành tiền</span>

                    </div>

                    <div class="checkout-product">

                        <!-- LEFT -->
                        <div class="product-info">

                            <img src="{{ asset($book->image) }}"
                                class="checkout-image"
                                alt="{{ $book->name }}">

                            <div>

                                <h4>
                                    {{ $book->name }}
                                </h4>

                                <p>
                                    Tác giả:
                                    {{ $book->author ?? 'Chưa cập nhật' }}
                                </p>

                            </div>

                        </div>

                        <!-- PRICE -->
                        <div class="price-box">

                            {{ number_format($book->price) }} ₫

                        </div>

                        <!-- QUANTITY -->
                        <div>

                            <input type="number"
                                name="quantity_input"
                                id="quantity"
                                class="qty-input"
                                min="1"
                                max="{{ $book->quantity }}"
                                value="1">

                        </div>

                        <!-- TOTAL -->
                        <div class="final-price">

                            <span id="thanhTien">
                                {{ number_format($book->price) }}
                            </span> ₫

                        </div>

                    </div>

                </div>

                <!-- Lời nhắn + vận chuyển -->
                <div class="content-card mb-4">

                    <div class="checkout-flex">

                        <div class="checkout-left">

                            <label>
                                <strong>Lời nhắn</strong>
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
                                Nhận hàng dự kiến 2-4 ngày
                            </small>

                        </div>

                    </div>

                </div>

                <!-- Voucher + tổng -->
                <div class="content-card">

                    <div class="mb-4">

                        <label>
                            <strong>Mã giảm giá</strong>
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
                                    {{ number_format($book->price) }}
                                </span> ₫
                            </strong>
                        </p>

                        <p>
                            Tổng tiền:
                            <strong>
                                <span id="tongTien">
                                    {{ number_format($book->price) }}
                                </span> ₫
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
            const gia = {
                {
                    $book - > price
                }
            };

            const quantityInput =
                document.getElementById('quantity');

            const hiddenQuantity =
                document.getElementById('hiddenQuantity');

            const couponInput =
                document.getElementById('coupon');

            const tongTien =
                document.getElementById('tongTien');

            const thanhTien =
                document.getElementById('thanhTien');

            const giaGoc =
                document.getElementById('giaGoc');

            function updatePrice() {

                const qty =
                    parseInt(quantityInput.value) || 1;

                hiddenQuantity.value = qty;

                let total =
                    gia * qty;

                let final =
                    total;

                // mã giảm 10%
                if (
                    couponInput.value
                    .trim()
                    .toUpperCase() === 'COLIEN'
                ) {

                    final =
                        total * 0.9;
                }

                giaGoc.innerText =
                    total.toLocaleString('vi-VN');

                thanhTien.innerText =
                    total.toLocaleString('vi-VN');

                tongTien.innerText =
                    Math.floor(final)
                    .toLocaleString('vi-VN');
            }

            quantityInput.addEventListener(
                'input',
                updatePrice
            );

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