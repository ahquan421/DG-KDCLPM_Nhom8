@extends('layouts.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container mt-4 product-show">
    <h2 class="mb-4 fw-bold">Chi tiết sản phẩm</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-3">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded shadow-sm border product-image">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center border rounded" 
                             style="width:100%; height:200px;">
                            <span class="text-muted">Không có ảnh</span>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <tbody>
                                <tr>
                                    <th style="width: 180px;">Tên sản phẩm</th>
                                    <td class="fw-semibold">{{ $product->name }}</td>
                                </tr>

                                <tr>
                                    <th>Giá</th>
                                    <td>
                                        <span class="fw-bold text-danger fs-5">
                                            {{ number_format($product->price, 0, ',', '.') }} ₫
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Số lượng</th>
                                    <td>{{ $product->quantity }}</td>
                                </tr>

                                <tr>
                                    <th>Tác giả</th>
                                    <td>{{ $product->author ?: '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Nhà xuất bản</th>
                                    <td>{{ $product->publisher ?: '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Số trang</th>
                                    <td>{{ $product->page ?: '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Mô tả</th>
                                    <td class="desc">{!! nl2br(e($product->description ?: '—')) !!}</td>
                                </tr>

                                <tr>
                                    <th>Năm xuất bản</th>
                                    <td>{{ $product->year_of_publication ?: '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Danh mục</th>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                </tr>

                                <tr>
                                    <th>Slug</th>
                                    <td class="text-muted">{{ $product->slug ?? '—' }}</td>
                                </tr>

                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                </tr>

                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-between">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                </a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Chỉnh sửa
                </a>
            </div>
        </div>
    </div>
</div>

@vite('resources/js/pages/product-show.js')
@endsection
