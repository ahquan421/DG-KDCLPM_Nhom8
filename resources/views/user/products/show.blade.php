@extends('layouts.user')

@section('title', $book->name . ' - Readora')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-5">
      <img src="{{ asset($book->image) }}" class="img-fluid rounded" alt="{{ $book->name }}">
    </div>
    <div class="col-md-7">
      <h2>{{ $book->name }}</h2>
      <p class="text-muted">Tác giả: {{ $book->author ?? 'N/A' }}</p>
      <h4 class="text-danger">{{ number_format($book->price, 0, ',', '.') }} ₫</h4>
      <p class="mt-3">{{ $book->description }}</p>
      <button class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
    </div>
  </div>
</div>
@endsection
