@extends('layouts.user')

@section('title', 'All Books - Readora')

@section('content')

<section class="bookstore py-5 bg-light">
  <div class="container d-flex justify-content-between align-items-start flex-wrap gap-4">

    {{-- ===== DANH SÁCH SÁCH BÊN TRÁI ===== --}}
    <div class="book-list-wrapper flex-grow-1" style="flex: 1;">
      <h2 class="text-center fw-bold mb-4">All Books</h2>

      <div class="book-list d-flex flex-wrap justify-content-center gap-4">
        @forelse ($products as $book)
        <div class="book-item text-center p-3 border rounded shadow-sm" style="width: 200px;">
          <a href="{{ route('user.products.show', $book->id) }}" class="text-decoration-none text-dark">
            <img src="{{ asset($book->image) }}" alt="{{ $book->name }}" class="img-fluid mb-2" style="height: 250px; object-fit: cover;">
            <h5 class="mb-2">{{ $book->name }}</h5>
          </a>
          <p class="price text-danger fw-bold mb-3">{{ number_format($book->price) }} ₫</p>
          <form action="{{ route('user.cart.add', $book->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-add">🛒 Add to Cart</button>
          </form>
        </div>
        @empty
        <p class="text-center text-muted">No books available at the moment.</p>
        @endforelse
      </div>

      <div class="mt-5 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
      </div>
    </div>

    {{-- ===== BỘ LỌC BÊN PHẢI ===== --}}
    <aside class="filter-sidebar bg-white shadow-sm rounded p-4" style="width: 250px;">
      <h5 class="fw-bold mb-4">Filter Books</h5>

      {{-- Lọc danh mục --}}
      <div class="mb-4">
        <h6 class="text-uppercase small text-muted mb-2">Category</h6>
        <form method="GET" action="{{ route('user.products.index') }}">
          @foreach ($categories as $category)
          <div class="form-check mb-1">
            <input class="form-check-input" type="radio" name="category"
              value="{{ $category->id }}"
              id="cat{{ $category->id }}"
              onchange="this.form.submit()"
              {{ request('category') == $category->id ? 'checked' : '' }}>
            <label class="form-check-label" for="cat{{ $category->id }}">
              {{ $category->name }}
            </label>
          </div>
          @endforeach
        </form>
      </div>

      {{-- Lọc theo giá (demo) --}}
      <div class="mb-4">
        <h6 class="text-uppercase small text-muted mb-2">Price</h6>
        <p class="text-muted small">Feature coming soon...</p>
      </div>

      {{-- Đánh giá --}}
      <div class="mb-4">
        <h6 class="text-uppercase small text-muted mb-2">Rating</h6>
        @for ($i = 5; $i >= 1; $i--)
        <div class="d-flex align-items-center mb-1">
          <input type="checkbox" id="star{{ $i }}" disabled>
          <label for="star{{ $i }}" class="ms-1">
            @for ($s = 1; $s <= $i; $s++) ⭐ @endfor
              </label>
        </div>
        @endfor
      </div>

      {{-- Nút xoá lọc --}}
      <a href="{{ route('user.products.index') }}" class="btn btn-danger btn-sm rounded-pill px-3">Clear Filters</a>
    </aside>
  </div>
</section>

@endsection