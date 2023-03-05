<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ route('homepage') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

      
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user') || request()->routeIs('user.edit') ? '' : 'collapsed' }}"
                href="{{ route('user') }}">
                <i class="bi bi-shield-fill-check"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('customer') || request()->routeIs('customer.edit') ? '' : 'collapsed' }}"
                href="{{ route('customer') }}">
                <i class="bi bi-person"></i>
                <span>Customers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('product') || request()->routeIs('product.edit') ? '' : 'collapsed' }}"
                href="{{ route('product') }}">
                <i class="bi bi-tags"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('category') || request()->routeIs('category.edit') ? '' : 'collapsed' }}"
                href="{{ route('category') }}">
                <i class="bi bi-c-circle"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pos') || request()->routeIs('pos.edit') ? '' : 'collapsed' }}"
                href="{{ route('pos') }}">
                <i class="bi bi-receipt"></i>
                <span>Pos</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('exchange-return') || request()->routeIs('exchange-return.edit') ? '' : 'collapsed' }}"
                href="{{ route('exchange-return') }}">
                <i class="bi bi-box-arrow-in-down-left"></i>
                <span>Return</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('') ? '' : 'collapsed' }}"
                href="{{ route('report') }}">
                <i class="bi bi-card-list"></i>
                <span>Report</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('setting') || request()->routeIs('setting.edit') ? '' : 'collapsed' }}"
                href="{{ route('setting') }}">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li> --}}
        

        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('category') ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-person"></i>
                <span>Customers</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link collapsed {{ request()->routeIs('banner-slider') ? '' : 'collapsed' }}"
                href="{{ route('banner-slider') }}">
                <i class="bi bi-card-image"></i>
                <span>Banner Slider</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link collapsed {{ request()->routeIs('customer') || request()->routeIs('customer.edit') ? '' : 'collapsed' }}"
                href="{{ route('customer') }}">
                <i class="bi bi-person"></i>
                <span>Customers</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('delivery') || request()->routeIs('delivery.edit') ? '' : 'collapsed' }}"
                href="{{ route('delivery') }}">
                <i class="bi bi-truck
                "></i>
                <span>Deliveries</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="/">
                <i class="bi bi-card-heading"></i>
                <span>Posts</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('brand') || request()->routeIs('brand.edit') || request()->routeIs('brand.create') ? '' : 'collapsed' }}"
                href="{{ route('brand') }}">
                <i class="bi bi-flower3"></i>
                <span>Brands</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('orders') }}">
                <i class="bi bi-cart3"></i>
                <span>Orders</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('contact') }}">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('settings') }}">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li><!-- End Contact Page Nav --> --}}



    </ul>

</aside>