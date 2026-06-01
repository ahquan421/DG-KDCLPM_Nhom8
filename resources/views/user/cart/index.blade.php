@extends('layouts.user')

@section('title', 'Giỏ hàng - Readora')

@section('content')

<div class="cart-page">

  <div class="container py-5">

    <div class="cart-header mb-4">
      <h2>
        Giỏ hàng
        <span>({{ $cartItems->count() }} sản phẩm)</span>
      </h2>
    </div>

    @if($cartItems->count() > 0)

    <!-- FORM CHO MUA NHIỀU -->
    <form action="{{ route('user.checkout.multiple') }}"
      method="POST">

      @csrf

      <div class="cart-list">

        @foreach($cartItems as $item)

        <div class="cart-item">

          <div class="cart-left">

            <!-- checkbox -->
            <input type="checkbox"
              name="selected_items[]"
              value="{{ $item->id }}"
              class="cart-checkbox"
              data-price="{{ $item->product->price * $item->quantity }}">

            <!-- ảnh -->
            <div class="cart-image">
              <img src="{{ asset($item->product->image) }}"
                alt="{{ $item->product->name }}">
            </div>

            <!-- info -->
            <div class="cart-info">

              <h3 class="book-name">
                {{ $item->product->name }}
              </h3>

              <p>
                Số lượng:
                <strong>
                  {{ $item->quantity }}
                </strong>
              </p>

              <p class="price">
                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} ₫
              </p>

            </div>

          </div>

          <!-- RIGHT -->
          <div class="cart-right">

            <!-- mua 1 sản phẩm -->
            <a href="{{ route('user.checkout.show', ['id' => $item->product->id]) }}"
              class="buy-btn">

              Mua ngay

            </a>

            <!-- xóa -->
            <a href="{{ route('user.cart.remove', $item->id) }}"
              class="remove-btn"
              onclick="event.preventDefault(); removeItem(this.href)">

              Xóa

            </a>

          </div>

        </div>

        @endforeach

      </div>

      <!-- FOOTER -->
      <div class="checkout-bar">

        <div class="checkout-info">

          Tổng tiền:
          <strong id="totalPrice">
            0 ₫
          </strong>

        </div>

        <button type="submit"
          class="checkout-btn">

          Mua hàng đã chọn

        </button>

      </div>

    </form>

    @else

    <div class="empty-cart">
      <h3>Giỏ hàng đang trống</h3>
    </div>

    @endif

  </div>

</div>

<script>
  const checkboxes =
    document.querySelectorAll('.cart-checkbox');

  const totalPrice =
    document.getElementById('totalPrice');

  function updateTotal() {

    let total = 0;

    checkboxes.forEach(box => {

      if (box.checked) {

        total += Number(box.dataset.price);
      }

    });

    totalPrice.innerText =
      total.toLocaleString('vi-VN') + ' ₫';
  }

  checkboxes.forEach(box => {

    box.addEventListener(
      'change',
      updateTotal
    );

  });

  // xóa sản phẩm
  function removeItem(url) {

    if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {

      const form =
        document.createElement('form');

      form.method = 'POST';
      form.action = url;

      form.innerHTML = `
                <input type="hidden"
                       name="_token"
                       value="{{ csrf_token() }}">

                <input type="hidden"
                       name="_method"
                       value="DELETE">
            `;

      document.body.appendChild(form);
      form.submit();
    }
  }
</script>

@endsection