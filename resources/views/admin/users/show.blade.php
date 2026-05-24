<!-- resources/views/admin/users/show.blade.php -->

@extends('layouts.admin')

@section('title', 'Chi tiết User')

@section('content')
<div class="container">
    <h2 class="mb-4">Chi tiết User</h2>

    <div class="card">
        <div class="card-body">
            <h4>Thông tin người dùng</h4>
            <ul>
                <li><strong>ID:</strong> {{ $user->id }}</li>
                <li><strong>Tên:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Vai trò:</strong> {{ ucfirst($user->usertype) }}</li>
                <li><strong>Ngày tạo:</strong> {{ $user->created_at }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $user->updated_at }}</li>
            </ul>
        </div>
    </div>

    <!-- Hiển thị địa chỉ người dùng -->
    <div class="card mt-4">
        <div class="card-body">
            <h4>Địa chỉ của người dùng</h4>
            @foreach($addresses as $address)
                <p><strong>Địa chỉ:</strong> {{ $address->address }}</p>
                <p><strong>Số điện thoại:</strong> {{ $address->phone }}</p>
                <p><strong>Địa chỉ mặc định:</strong> {{ $address->is_default ? 'Có' : 'Không' }}</p>
                <hr>
            @endforeach
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4>Đơn hàng của người dùng</h4>
            @foreach($orders as $order)
                <p><strong>Ngày đặt:</strong> {{ $order->date }}</p>
                <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_money, 2) }} VND</p>
                <hr>
            @endforeach
        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-4">Trở lại</a>
</div>
@endsection
