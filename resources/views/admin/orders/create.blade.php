@extends('layouts.admin')

@section('title', 'Tạo đơn hàng')

@section('content')
<div class="container">
    <h2>Đặt hàng mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Chọn địa chỉ giao hàng</label>
            <select name="address_id" class="form-control" required>
                <option value="">-- Chọn địa chỉ --</option>
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">
                        {{ $address->address }} @if($address->is_default) (Mặc định) @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái đơn hàng</label>
            <select name="status" class="form-control" required>
                <option value="pending">Chờ xử lý</option>
                <option value="confirmed">Đã xác nhận</option>
                <option value="shipping">Đang giao</option>
                <option value="completed">Hoàn thành</option>
                <option value="cancelled">Đã hủy</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Đặt hàng</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
