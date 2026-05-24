@extends('layouts.admin')

@section('title', 'Chỉnh sửa Đơn hàng')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Đơn hàng #{{ $order->id }}</h2>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="customer_id">Khách hàng</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address_id">Địa chỉ</label>
            <select name="address_id" id="address_id" class="form-control" required>
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}" {{ $order->address_id == $address->id ? 'selected' : '' }}>
                        {{ $address->full_address }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                @foreach(['pending', 'confirmed', 'shipping', 'completed', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="totalMoney">Tổng tiền</label>
            <input type="number" name="totalMoney" id="totalMoney" class="form-control" step="0.01" value="{{ $order->totalMoney }}" required>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
