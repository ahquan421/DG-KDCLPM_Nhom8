@extends('layouts.user')

@section('title', 'Shopping Cart - Readora')

@section('content')
<div class="container py-5">
  <h2 class="mb-4 text-center">🛒 Your Cart</h2>

  @if($cartItems->count() > 0)
    <table class="table table-bordered align-middle text-center">
      <thead class="table-light">
        <tr>
          <th>Image</th>
          <th>Book Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cartItems as $item)
          <tr>
            <td>
              <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                   style="width:60px; height:80px; object-fit:cover;">
            </td>
            <td>{{ $item->product->name }}</td>
            <td>{{ number_format($item->product->price, 0, ',', '.') }} ₫</td>
            <td>
              <div class="d-inline-flex align-items-center">
                <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                  @csrf
                  @method('PUT')
                  <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary me-2">−</button>
                  <span class="px-2">{{ $item->quantity }}</span>
                  <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary ms-2">+</button>
                </form>
              </div>
            </td>
            <td><strong>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} ₫</strong></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="text-end mt-4">
      <h5 class="mb-3">Subtotal:
        <span class="text-primary fw-bold">
          {{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->quantity), 0, ',', '.') }} ₫
        </span>
      </h5>

      <a href="{{ route('user.checkout.show', ['id' => Auth::id()]) }}" class="btn btn-primary px-4 py-2">
        🧾 Continue to Checkout
      </a>
    </div>
  @else
    <p class="text-center text-muted mt-5">Your cart is empty 😢</p>
  @endif
</div>
@endsection
