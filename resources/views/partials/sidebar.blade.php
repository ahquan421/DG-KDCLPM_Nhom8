<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/admin/dashboard">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Danh mục</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href={{ route('admin.products.index') }}>
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Sản phẩm</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Đơn hàng</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Người dùng</span>
            </a>
          </li>

        </ul>
      </nav>