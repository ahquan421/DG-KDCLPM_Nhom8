<x-app-layout>

    <div style="padding:30px;">

        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

        <p>
            Trạng thái:
            {{ $order->status }}
        </p>

        <p>
            Tổng tiền:
            {{ number_format($order->total_money) }} ₫
        </p>

        <hr>

        <h3>Sản phẩm</h3>

        @foreach($order->orderDetails as $item)

        <div style="margin-bottom:20px;">

            <h4>
                {{ $item->product->name }}
            </h4>

            <p>
                Số lượng:
                {{ $item->quantity }}
            </p>

            <p>
                Giá:
                {{ number_format($item->price) }} ₫
            </p>

        </div>

        @endforeach

    </div>

</x-app-layout>