<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome Readora</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</span></h6>

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{asset('images/dashboard/people.svg')}}" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Ha Noi</h4>
                        <h6 class="font-weight-normal">Viet Nam</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Products</p>
                      <p class="fs-30 mb-2">{{ $totalProducts }}</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Categories</p>
                      <p class="fs-30 mb-2">{{ $totalCategories }}</p>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Orders</p>
                      <p class="fs-30 mb-2">{{ $totalOrders }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Tổng số khách hàng</p>
                      <p class="fs-30 mb-2">{{ $totalClients }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-2 align-items-end mb-3">
            <div class="col-auto">
              <label for="year" class="form-label mb-0">Năm</label>
              <select name="year" id="year" class="form-select">
                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                  <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                    {{ $y }}
                  </option>
                @endfor
              </select>
            </div>

            <div class="col-auto">
              <label for="month" class="form-label mb-0">Tháng</label>
              <select name="month" id="month" class="form-select">
                <option value="">Tất cả</option>
                @for ($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                    Tháng {{ $m }}
                  </option>
                @endfor
              </select>
            </div>

            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
          </form>

          <div class="row">
            {{-- ===== CỘT TRÁI: ORDER DETAILS ===== --}}
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Order Details</p>
                  <p class="font-weight-500 mb-3">Danh sách 5 đơn hàng gần nhất</p>

                  <div class="table-responsive">
                    <table class="table table-striped table-borderless align-middle">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Customer</th>
                          <th>Total Money</th>
                          <th>Status</th>
                          <th>Order Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($recentOrders as $order)
                          <tr>
                            <td>
                              <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary fw-semibold">
                                #{{ $order->id }}
                              </a>
                            </td>
                            <td>{{ $order->customer->name ?? 'N/A' }}</td>
                            <td>{{ number_format($order->total_money, 0, ',', '.') }} ₫</td>
                            <td>
                              @php
                                $statusClass = match($order->status) {
                                  'pending'   => 'badge bg-secondary',
                                  'confirmed' => 'badge bg-info',
                                  'shipping'  => 'badge bg-primary',
                                  'completed' => 'badge bg-success',
                                  'cancelled' => 'badge bg-danger',
                                  default     => 'badge bg-light text-dark',
                                };
                              @endphp
                              <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="5" class="text-center text-muted py-3">Chưa có đơn hàng nào</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>

                  {{-- Tổng cộng --}}
                  <div class="text-end mt-3">
                    <strong>Tổng doanh thu 5 đơn gần nhất:</strong>
                    <span class="text-primary fw-bold">
                      {{ number_format($recentOrdersTotal, 0, ',', '.') }} ₫
                    </span>
                  </div>
                </div>
              </div>
            </div>

            {{-- ===== CỘT PHẢI: SALES REPORT ===== --}}
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <p class="card-title">Báo cáo doanh thu</p>
                  </div>

                  <p class="font-weight-500">Biểu đồ doanh thu theo tháng trong {{ $year }}.</p>

                  <div class="text-center mb-3">
                    <h4 class="font-weight-bold text-success">
                      Tổng doanh thu: {{ number_format($totalYear, 0, ',', '.') }} ₫
                    </h4>
                  </div>
                  {{-- Bảng doanh thu theo tháng từ CSDL --}}
                  <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped">
                      <thead class="table-light">
                        <tr>
                          <th>Tháng</th>
                          <th>Doanh thu (₫)</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($revenues as $r)
                          <tr>
                            <td>Tháng {{ $r->month }}</td>
                            <td>{{ number_format($r->total, 0, ',', '.') }} ₫</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="2" class="text-center text-muted py-3">Chưa có doanh thu trong năm {{ $year }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
              </div>
            </div>
          </div>
          <div class="row">
            {{-- ===== TOP PRODUCTS ===== --}}
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top sản phẩm</p>
                  <p class="text-muted small mb-3">5 sản phẩm bán chạy nhất trong tháng hiện tại</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless align-middle">
                      <thead>
                        <tr>
                          <th>Sản phẩm</th>
                          <th>Giá</th>
                          <th>Đã bán</th>
                          <th>Trạng thái</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($topProducts as $product)
                          <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                            <td>{{ $product->total_sold }}</td>
                            <td>
                              <div class="badge {{ $product->total_sold > 0 ? 'badge-success' : 'badge-secondary' }}">
                                {{ $product->total_sold > 0 ? 'Available' : 'Out of stock' }}
                              </div>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                              Chưa có dữ liệu bán hàng trong tháng này
                            </td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            {{-- ===== LOW STOCK PRODUCTS ===== --}}
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Sản phẩm sắp hết hàng</p>
                  <p class="text-muted small mb-3">Danh sách 5 sản phẩm có số lượng tồn kho dưới 5</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless align-middle">
                      <thead>
                        <tr>
                          <th>Tên sản phẩm</th>
                          <th>Tồn kho</th>
                          <th>Trạng thái</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse(App\Models\Product::where('quantity', '<', 5)->orderBy('quantity')->take(5)->get() as $item)
                          <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                              @if($item->quantity == 0)
                                <div class="badge badge-danger">Hết hàng</div>
                              @elseif($item->quantity < 5)
                                <div class="badge badge-warning text-dark">Sắp hết</div>
                              @else
                                <div class="badge badge-success">Còn hàng</div>
                              @endif
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3" class="text-center text-muted py-3">Tất cả sản phẩm đều đủ hàng</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>