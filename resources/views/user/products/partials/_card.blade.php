<div class="col-6 col-md-4 col-lg-3">
  <div class="card h-100 shadow-sm border-0">
    <img src="{{ asset($book->image) }}" alt="{{ $book->name }}" class="card-img-top" style="height:300px;object-fit:cover;">
    <div class="card-body text-center">
      <h6 class="fw-bold">{{ $book->name }}</h6>
      <p class="text-muted small mb-1">{{ $book->author ?? 'Unknown Author' }}</p>
      <p class="text-primary fw-bold mb-2">{{ number_format($book->price, 0, ',', '.') }} ₫</p>
      <button class="btn btn-danger btn-sm">Add to Cart</button>
    </div>
  </div>
</div>
