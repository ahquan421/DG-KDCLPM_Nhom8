<aside class="shop-sidebar" style="width:250px;">
  <h5 class="fw-bold mb-3">Khám phá theo danh mục</h5>

  {{-- Danh mục --}}
  <div class="mb-4">
    <h6 class="text-uppercase text-muted mb-2">Product Category</h6>
    <ul class="list-unstyled">
      @foreach ($categories as $category)
        <li class="mb-1">
          <a href="{{ route('user.products.index', ['category' => $category->id]) }}"
             class="{{ request('category') == $category->id ? 'fw-bold text-primary' : 'text-dark' }}">
             {{ $category->name }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>

  {{-- Đánh giá --}}
  <div class="mb-4">
    <h6 class="text-uppercase text-muted mb-2">Đánh giá</h6>
    @for ($i = 5; $i >= 1; $i--)
      <div>
        <input type="checkbox" id="rating-{{ $i }}">
        <label for="rating-{{ $i }}">
          @for ($s = 1; $s <= $i; $s++) ⭐ @endfor
        </label>
      </div>
    @endfor
  </div>

  <button class="btn btn-outline-danger btn-sm mt-2">Clear Filters</button>
</aside>
