@extends('layouts.user')

@section('title', 'Shopping Cart - Readora')

@section('content')
<div class="container py-5">
  <h3 class="fw-bold mb-4">Your Cart <span class="text-muted small">({{ $cartItems->count() }})</span></h3>

  @if($cartItems->count() > 0)
  <div class="table-responsive">
    <table class="table align-middle">
      <tbody>
        @foreach($cartItems as $item)
        <tr class="cart-row align-middle border-bottom">
          <!-- Checkbox -->
          <td width="5%">
            <input type="checkbox" class="form-check-input">
          </td>

          <!-- Image + Name -->
          <td width="45%">
            <div class="d-flex align-items-center">
              <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" 
                   class="rounded" width="70" height="90" style="object-fit: cover;">
              <div class="ms-3">
                <h6 class="mb-1 fw-semibold">{{ $item->product->name }}</h6>
                <p class="text-muted mb-0">{{ number_format($item->product->price, 0, ',', '.') }} ₫</p>
              </div>
            </div>
          </td>

          <!-- Quantity -->
          <td width="25%">
            <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center justify-content-center">
              @csrf
              @method('PUT')
              <button type="submit" name="action" value="decrease" class="btn btn-light border rounded-circle px-2 py-1">−</button>
              <span class="mx-3 fw-bold">{{ $item->quantity }}</span>
              <button type="submit" name="action" value="increase" class="btn btn-light border rounded-circle px-2 py-1">+</button>
            </form>
          </td>

          <!-- Total -->
          <td width="25%" class="text-end fw-bold text-dark">
            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} ₫
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Summary -->
  <div class="mt-4 text-end">
    <h5 class="fw-semibold">
      Total: 
      <span class="text-primary fw-bold">
        {{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->quantity), 0, ',', '.') }} ₫
      </span>
    </h5>

    <a href="{{ route('user.checkout.show', ['id' => Auth::id()]) }}" 
       class="btn btn-dark rounded-pill px-4 py-2 mt-3">
       Proceed to Checkout →
    </a>
  </div>

  @else
    <p class="text-center text-muted mt-5">Your cart is empty 😢</p>
  @endif
</div>
@endsection
