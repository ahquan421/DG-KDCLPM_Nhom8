@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-4">
  <h4 class="mb-3">Chi tiết đơn hàng #{{ $order->id }}</h4>

  <div class="card p-3 mb-3">
    <p><strong>Khách hàng:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
    <p><strong>Ngày đặt:</strong> {{ $order->order_date ?? $order->date }}</p>
    <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_money, 0, ',', '.') }} đ</p>
  </div>

  <h5>Sản phẩm trong đơn</h5>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Thành tiền</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->orderDetails as $item)
        <tr>
          <td>{{ $item->product->name ?? 'N/A' }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
          <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">← Quay lại</a>
</div>
@endsection
