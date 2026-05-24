@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h3>Your Orders</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Status</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->date->format('d/m/Y H:i') }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        <td>{{ number_format($order->total_money, 0, ',', '.') }} ₫</td>
        <td><a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
