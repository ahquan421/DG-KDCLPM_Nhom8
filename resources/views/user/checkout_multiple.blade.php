<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Online Bookstore</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<x-app-layout>
<div class="container mt-4">
    <h2>💳 Thanh toán nhiều sản phẩm</h2>

    <ul class="list-group mb-3">
        @foreach ($books as $item)
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    <strong>{{ $item['name'] }}</strong>
                    <br>Giá: {{ number_format($item['price']) }} ₫
                    <br>Số lượng: {{ $item['quantity'] }}
                </div>
                <span class="text-danger fw-bold">{{ number_format($item['price'] * $item['quantity']) }} ₫</span>
            </li>
        @endforeach
    </ul>

    <p class="fw-bold fs-5">Tổng cộng:
        {{ number_format(collect($books)->sum(fn($i) => $i['price'] * $i['quantity'])) }} ₫
    </p>

    <button class="btn btn-primary">Xác nhận thanh toán</button>
</div>
</x-app-layout>
