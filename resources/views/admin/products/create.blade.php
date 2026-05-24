@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<div class="product-form">
  <div class="container-fluid px-3 px-md-4">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="ui-card p-3 p-md-4">
        <div class="row g-4">
          <div class="col-lg-7">
            <div class="ui-section p-3 p-md-4 h-100">
              <h5 class="fw-bold mb-1">Product Information</h5>
              <p class="hint mb-4">Lorem ipsum dolor sit amet consectetur. Non ac nulla aliquam aenean in velit mattis.</p>

              <div class="mb-3">
                <label class="lbl">ID (tùy chọn)</label>
                <input type="number" name="id" class="form-control fld" value="{{ old('id') }}" min="1" placeholder="Bỏ trống để hệ thống tự tạo">
              </div>

              <div class="mb-3">
                <label class="lbl">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control fld" value="{{ old('name') }}" required>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="lbl">Giá</label>
                  <input type="number" step="0.01" name="price" class="form-control fld" value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6">
                  <label class="lbl">Số lượng</label>
                  <input type="number" name="quantity" class="form-control fld" value="{{ old('quantity') }}" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="lbl">Tác giả</label>
                  <input type="text" name="author" class="form-control fld" value="{{ old('author') }}">
                </div>
                <div class="col-md-6">
                  <label class="lbl">Nhà xuất bản</label>
                  <input type="text" name="publisher" class="form-control fld" value="{{ old('publisher') }}">
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="lbl">Số trang</label>
                  <input type="number" name="page" class="form-control fld" value="{{ old('page') }}">
                </div>
                <div class="col-md-6">
                  <label class="lbl">Năm xuất bản</label>
                  <input type="number" name="year_of_publication" class="form-control fld" value="{{ old('year_of_publication') }}">
                </div>
              </div>

              <div class="mt-3">
                <label class="lbl">Mô tả</label>
                <textarea name="description" class="form-control fld" rows="4">{{ old('description') }}</textarea>
              </div>

              <div class="mt-3">
                <label class="lbl">Danh mục</label>
                <select name="category_id" class="form-select fld" required>
                  <option value="">-- Chọn danh mục --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                <input type="file" name="image" class="d-none" accept="image/*" onchange="previewSingle(this)">
                <div id="dropArea" class="drop w-100">
                  <i class="fa-regular fa-image fa-2xl mb-1"></i>
                  <span id="dropText">Photo</span>
                  <img id="previewImg" class="d-none rounded" style="max-height:160px" alt="preview">
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

@vite('resources/js/pages/product-create.js')
@endsection
