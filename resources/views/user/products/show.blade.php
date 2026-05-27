@extends('layouts.user')

@section('content')

<div class="product-wrapper">

    <!-- BACK -->
    <div class="back-box">
        <a href="{{ url('/user/dashboard') }}" class="back-link">
            ← Quay lại
        </a>
    </div>

    <!-- PRODUCT CARD -->
    <div class="product-card">

        <!-- LEFT -->
        <div class="product-left">

            <div class="image-box">
                <img src="{{ asset($book->image) }}"
                    alt="{{ $book->name }}">
            </div>

        </div>

        <!-- RIGHT -->
        <div class="product-right">

            <!-- TITLE -->
            <h1 class="product-title">
                {{ $book->name }}
            </h1>

            <!-- INFO -->
            <div class="product-meta">

                <p>
                    <strong>✍️ Tác giả:</strong>
                    {{ $book->author }}
                </p>

                <p>
                    <strong>🏢 Nhà xuất bản:</strong>
                    {{ $book->publisher }}
                </p>

                <p>
                    <strong>📚 Thể loại:</strong>
                    {{ $book->category_id }}
                </p>

            </div>

            <!-- PRICE -->
            <div class="price-section">

                <span class="price-old">
                    {{ number_format($book->price + 50000) }}đ
                </span>

                <span class="discount">
                    -20%
                </span>

                <div class="price-new">
                    {{ number_format($book->price) }}đ
                </div>

            </div>

            <!-- STOCK -->
            <div class="stock-box">
                Còn lại:
                <strong>{{ $book->quantity }}</strong>
                cuốn
            </div>

            <!-- ACTION -->
            <div class="action-box">

                <!-- BUY NOW -->
                <form action="{{ route('user.checkout.show', $book->id) }}"
                    method="GET"
                    class="action-form">

                    <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $book->quantity }}"
                        class="qty-input">

                    <button class="buy-btn">
                        ⚡ Mua ngay
                    </button>

                </form>

                <!-- CART -->
                <form method="POST"
                    action="{{ route('user.cart.add', $book->id) }}"
                    class="action-form">

                    @csrf

                    <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $book->quantity }}"
                        class="qty-input">

                    <button type="submit"
                        class="cart-btn">
                        🛒 Thêm vào giỏ
                    </button>

                    <a href="{{ route('user.cart.index') }}"
                        class="view-cart-btn">
                        Xem giỏ
                    </a>

                </form>

            </div>

            <!-- SHIPPING -->
            <div class="shipping-box">

                <p>
                    ✔ Free shipping cho đơn từ 149.000đ
                </p>

                <p>
                    ✔ Hỗ trợ đổi trả trong 7 ngày
                </p>

                <p>
                    ✔ Giao hàng nhanh toàn quốc
                </p>

            </div>

        </div>

    </div>

    <!-- DESCRIPTION -->
    <div class="content-card">

        <div class="tabs">

            <button class="active">
                Mô tả sản phẩm
            </button>

            <button>
                Thông tin
            </button>

            <button>
                Đánh giá
            </button>

        </div>

        <div class="desc">
            {!! $book->description !!}
        </div>

    </div>

    <!-- DETAIL TABLE -->
    <div class="content-card">

        <h3 class="detail-title">
            📘 Thông tin chi tiết
        </h3>

        <table class="detail-table">

            <tr>
                <th>Tên sách</th>
                <td>{{ $book->name }}</td>
            </tr>

            <tr>
                <th>Tác giả</th>
                <td>{{ $book->author }}</td>
            </tr>

            <tr>
                <th>Nhà xuất bản</th>
                <td>{{ $book->publisher }}</td>
            </tr>

            <tr>
                <th>Năm xuất bản</th>
                <td>{{ $book->year_of_publication }}</td>
            </tr>

            <tr>
                <th>Giá bán</th>
                <td>{{ number_format($book->price) }}đ</td>
            </tr>

            <tr>
                <th>Số lượng còn lại</th>
                <td>{{ $book->quantity }}</td>
            </tr>

            <tr>
                <th>Số trang</th>
                <td>{{ $book->page }}</td>
            </tr>

            <tr>
                <th>Mô tả</th>
                <td>{!! $book->description !!}</td>
            </tr>

        </table>

    </div>

</div>

@endsection