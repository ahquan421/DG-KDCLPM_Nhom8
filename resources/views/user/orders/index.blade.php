<x-app-layout>

    <div style="padding:30px;">

        <h2 style="font-size:28px;font-weight:bold;margin-bottom:20px;">
            📦 Tất cả đơn hàng của bạn
        </h2>

        @if(session('success'))
            <div style="
                background:#d4edda;
                color:#155724;
                padding:15px;
                border-radius:8px;
                margin-bottom:20px;
            ">
                {{ session('success') }}
            </div>
        @endif

        @forelse($orders as $order)

            <div style="
                border:1px solid #ddd;
                border-radius:12px;
                padding:20px;
                margin-bottom:20px;
                background:#fff;
            ">

                <h3>
                    Đơn hàng #{{ $order->id }}
                </h3>

                <p>
                    Trạng thái:
                    <strong>
                        {{ $order->status }}
                    </strong>
                </p>

                <p>
                    Tổng tiền:
                    <strong>
                        {{ number_format($order->total_money) }} ₫
                    </strong>
                </p>

                <p>
                    Ngày đặt:
                    {{ $order->created_at }}
                </p>

                <hr>

                <h4>Sản phẩm:</h4>

                @foreach($order->orderDetails as $item)

                    <div style="
                        margin-top:10px;
                        padding:10px;
                        border-bottom:1px solid #eee;
                    ">

                        <strong>
                            {{ $item->product->name }}
                        </strong>

                        <br>

                        Số lượng:
                        {{ $item->quantity }}

                        <br>

                        Giá:
                        {{ number_format($item->price) }} ₫

                    </div>

                @endforeach

            </div>

        @empty

            <p>
                Bạn chưa có đơn hàng nào.
            </p>

        @endforelse

    </div>

</x-app-layout>