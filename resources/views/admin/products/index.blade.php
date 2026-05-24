@extends('layouts.admin')

@section('content')

{{-- ====== THÔNG BÁO ====== --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    <i class="fa-solid fa-circle-check me-2"></i> 
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    <i class="fa-solid fa-triangle-exclamation me-2"></i> 
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="products-index">
  <div class="card shadow-sm p-3">

    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
      <form method="GET" action="{{ route('admin.products.index') }}" id="filterForm"
            class="flex-grow-1 me-2" style="max-width:520px;">
        <div class="position-relative">
          <i class="fa-solid fa-magnifying-glass search-ico"></i>
          <input type="text" name="q" value="{{ request('q') }}" class="form-control search-input"
                placeholder="Tìm theo ID, tên, tác giả hoặc NXB">
          @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
          @endif
        </div>
      </form>

      <form method="GET" action="{{ route('admin.products.index') }}" id="sortForm"
            class="d-flex align-items-center gap-2">
        <select name="sort" class="form-select" id="sortSelect" onchange="this.form.submit()">
          @php $sort = request('sort','latest'); @endphp
          <option value="latest"   {{ $sort=='latest' ? 'selected' : '' }}>Mới nhất</option>
          <option value="oldest"   {{ $sort=='oldest' ? 'selected' : '' }}>Cũ nhất</option>
          <option value="price_asc"  {{ $sort=='price_asc' ? 'selected' : '' }}>Giá ↑</option>
          <option value="price_desc" {{ $sort=='price_desc' ? 'selected' : '' }}>Giá ↓</option>
        </select>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
          <i class="fa-solid fa-plus me-1"></i> Thêm sách
        </a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table align-middle table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Sách</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th class="text-end">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td class="d-flex align-items-center">
                @if($product->image)
                  <img src="{{ asset($product->image) }}" class="product-thumb me-2" alt="{{ $product->name }}">
                @else
                  <div class="bg-light rounded me-2" style="width:40px;height:40px;"></div>
                @endif
                <div>
                  <a href="{{ route('admin.products.show', $product->id) }}" class="fw-bold text-primary">{{ $product->id }}</a>
                  <div>{{ $product->name }}</div>
                </div>
              </td>
              <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
              <td>{{ $product->category->name ?? '—' }}</td>
              <td>{{ $product->quantity }}</td>
              <td>
                @if($product->quantity > 0)
                  <span class="badge bg-success">Available</span>
                @else
                  <span class="badge bg-danger">Out of Stock</span>
                @endif
              </td>
              <td class="text-end">
                <a href="{{ route('admin.products.show', $product->id) }}" class="text-primary me-2" title="View">
                  <i class="fa-solid fa-eye"></i>
                </a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-warning me-2" title="Edit">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-link p-0 text-danger" onclick="return confirm('Delete this book?')" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="7" class="text-center py-4">Không có sản phẩm nào</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
      <div>
        Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
      </div>
      <div class="d-flex justify-content-end">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
      </div>
    </div>

  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection
