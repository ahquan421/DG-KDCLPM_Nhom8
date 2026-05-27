<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Giỏ hàng</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<x-app-layout>
<div class="container mt-5">

    <h2 class="mb-4 text-primary">🛒 GIỎ HÀNG ({{ count($cart) }} sản phẩm)</h2>

    @if (empty($cart))
        <div class="alert alert-info">Chưa có sách nào trong giỏ hàng.</div>
    @else
        {{-- ✅ Form chính bao toàn bộ danh sách --}}
        <form id="checkoutForm" method="POST" action="{{ route('user.checkout.multiple') }}">
            @csrf

            <div class="row row-cols-1 g-4">
                @foreach ($cart as $item)
                    <div class="col">
                        <div class="card p-3 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">

                                {{-- ✅ Checkbox + Thông tin --}}
                                <div class="d-flex align-items-center">
                                    <input type="checkbox"
                                           name="selected_items[]"
                                           value="{{ $item['id'] }}"
                                           class="form-check-input me-3">

                                    <img src="{{ asset($item['image']) }}"
                                         alt="{{ $item['name'] }}"
                                         style="width:100px; height:140px; object-fit:cover;"
                                         class="rounded me-3">

                                    <div>
                                        <h5 class="mb-1">{{ $item['name'] }}</h5>
                                        <p class="mb-0 text-danger fw-bold fs-5">
                                            {{ number_format($item['price']) }} ₫
                                        </p>
                                        <p class="mb-0 text-secondary">Số lượng: {{ $item['quantity'] }}</p>
                                    </div>
                                </div>

                                {{-- ✅ Nút Xóa: dùng nút riêng, không lồng form --}}
                                <button type="button"
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="removeItem('{{ route('user.cart.remove', $item['id']) }}')">
                                    🗑 Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ✅ Nút Mua ngay --}}
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success btn-lg">💳 Mua ngay</button>
            </div>
        </form>
    @endif
</div>

{{-- ✅ Script xóa riêng --}}
<script>
function removeItem(url) {
    if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng không?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.innerHTML = `
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

</x-app-layout>
</body>
</html>