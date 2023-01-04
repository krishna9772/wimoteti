<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ route('homepage') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('category') || request()->routeIs('category.create') || request()->routeIs('category.edit') || request()->routeIs('brand') || request()->routeIs('brand.edit') || request()->routeIs('brand.create') || request()->routeIs('product') || request()->routeIs('product.edit') || request()->routeIs('product.show') || request()->routeIs('product.create') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Catalog</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav"
                class="nav-content {{ request()->routeIs('category') || request()->routeIs('category.create') || request()->routeIs('category.edit') || request()->routeIs('brand') || request()->routeIs('brand.edit') || request()->routeIs('brand.create') || request()->routeIs('product') || request()->routeIs('product.edit') || request()->routeIs('product.show') || request()->routeIs('list.attr') || request()->routeIs('add.attr') || request()->routeIs('edit.attr') ? '' : 'collapse' }} "
                data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('category') }}">
                        <i class="bi bi-receipt" style="font-size: 20px"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brand') }}">
                        <i class="bi bi-type-bold" style="font-size: 20px"></i><span>Brands</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product') }}">
                        <i class="bi bi-tags" style="font-size: 20px"></i><span>Products</span>
                    </a>
                </li>
                </li>
                <li>
                    <a href="{{ route('list.attr') }}">
                        <i class="bi bi-tags" style="font-size: 20px"></i><span>Product Attributes</span>
                    </a>
                </li>
            </ul>
        </li> --}}
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
                <i class="bi bi-receipt"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('setting') || request()->routeIs('setting.edit') ? '' : 'collapsed' }}"
                href="{{ route('setting') }}">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
            </a>
        </li>
        

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