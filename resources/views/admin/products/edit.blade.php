@extends('layouts.admin')

@section('title', 'Cập nhật sản phẩm')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<div class="product-form">
  <div class="container-fluid px-3 px-md-4">
    <h4 class="fw-bold mb-3">Cập nhật sản phẩm</h4>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
      @csrf
      @method('PUT')

      <div class="ui-card p-3 p-md-4">
        <div class="row g-4">
          <div class="col-lg-7">
            <div class="ui-section p-3 p-md-4 h-100">
              <h5 class="fw-bold mb-1">Product Information</h5>
              <p class="hint mb-4">Chỉnh sửa thông tin sản phẩm của bạn.</p>

              <div class="mb-3">
                <label class="lbl">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control fld"
                       value="{{ old('name', $product->name) }}" required>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="lbl d-block">Giá</label>
                  <div class="input-group">
                    <span class="input-group-text">₫</span>
                    <input
                      type="text"
                      id="price_display"
                      class="form-control currency-input"
                      inputmode="numeric"
                      placeholder="Nhập giá (VND)"
                      value="{{ old('price', number_format($product->price, 0, ',', '.')) }}"
                      autocomplete="off">
                  </div>
                  <input type="hidden" id="price" name="price" value="{{ old('price', $product->price) }}">
                </div>

                <div class="col-md-6">
                  <label class="lbl">Số lượng</label>
                  <input type="number" name="quantity" class="form-control fld"
                         value="{{ old('quantity', $product->quantity) }}" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="lbl">Tác giả</label>
                  <input type="text" name="author" class="form-control fld"
                         value="{{ old('author', $product->author) }}">
                </div>
                <div class="col-md-6">
                  <label class="lbl">Nhà xuất bản</label>
                  <input type="text" name="publisher" class="form-control fld"
                         value="{{ old('publisher', $product->publisher) }}">
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="lbl">Số trang</label>
                  <input type="number" name="page" class="form-control fld"
                         value="{{ old('page', $product->page) }}">
                </div>
                <div class="col-md-6">
                  <label class="lbl">Năm xuất bản</label>
                  <input type="number" name="year_of_publication" class="form-control fld"
                         value="{{ old('year_of_publication', $product->year_of_publication) }}">
                </div>
              </div>

              <div class="mt-3">
                <label class="lbl">Mô tả</label>
                <textarea name="description" class="form-control fld" rows="4">{{ old('description', $product->description) }}</textarea>
              </div>

              <div class="mt-3">
                <label class="lbl">Danh mục</label>
                <select name="category_id" class="form-select fld" required>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                      {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="ui-section p-3 p-md-4 h-100 d-flex flex-column">
              <h5 class="fw-bold mb-1">Image Product</h5>
              <div class="hint mb-3"><strong>Note :</strong> SVG, PNG hoặc JPG (tối đa 4MB)</div>

              <label class="w-100">
                <input type="file" name="image" class="d-none" accept="image/*"
                       onchange="previewSingle(this)">
                <div id="dropArea" class="drop w-100">
                  <i class="fa-regular fa-image fa-2xl mb-1"></i>
                  <span id="dropText">Chọn ảnh</span>

                  @if($product->image)
                    <img id="previewImg"
                         src="{{ asset($product->image) }}"
                         class="preview-img mt-1" alt="Ảnh hiện tại">
                  @else
                    <img id="previewImg" class="d-none preview-img mt-1" alt="Preview ảnh">
                  @endif
                </div>
              </label>

              <div class="mt-auto d-flex justify-content-between pt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-pill px-4">Cancel</a>
                <button type="submit" class="btn btn-primary btn-pill px-4">Save Product</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

@vite('resources/js/pages/product-edit.js')
@endsection
