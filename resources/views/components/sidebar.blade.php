<aside>
    <div class="top">
        <div class="logo">
            <a href="{{ route('website.index') }}">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" /></a>
        </div>
        <div class="close2" id="closeBtn2">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <div class="sidebar2">


        {{-- Dashboard --}}
        <a href="{{ route('admin.index') }}" class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <span class="material-icons-sharp"> grid_view </span>
            <h3>Dashboard</h3>
        </a>
        {{-- Users --}}
        <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->is('admin/users*') ? 'active' : '' }}">
            <span class="material-icons-sharp"> groups </span>
            <h3>Users</h3>
            {{-- <i class="fas fa-chevron-right icon"></i> --}}
        </a>
        {{-- <ul class="submenu {{ request()->is('admin/users*') ? 'open' : '' }}">
        <li>
            <a href="{{ route('admin.users.index') }}"
                class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <span class="material-icons-sharp"> select_all </span> All Users
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.create') }}"
                class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <span class="material-icons-sharp"> library_add </span> Add New User
            </a>
        </li>
        </ul> --}}
        {{-- Categories --}}
        <a href="{{ route('admin.categories.index') }}" class="menu-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
            <span class="material-icons-sharp"> sell </span>
            <h3>Categories</h3>
            {{-- <i class="fas fa-chevron-right icon"></i> --}}
        </a>
        {{-- <ul class="submenu {{ request()->is('admin/categories*') ? 'open' : '' }}">
        <li>
            <a href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                <span class="material-icons-sharp"> apps </span> All Category
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.create') }}"
                class="{{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                <span class="material-icons-sharp"> library_add </span> Add New Category
            </a>
        </li>
        </ul> --}}

        {{-- Products --}}
        <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->is('admin/products*') ? 'active' : '' }}">
            <span class="material-icons-sharp"> favorite </span>
            <h3>Products</h3>
            {{-- <i class="fas fa-chevron-right icon"></i> --}}
        </a>
        {{-- <ul class="submenu {{ request()->is('admin/products*') ? 'open' : '' }}">
        <li>
            <a href="{{ route('admin.products.index') }}"
                class="{{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                <span class="material-icons-sharp"> select_all </span> All Product
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.create') }}"
                class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <span class="material-icons-sharp"> add_shopping_cart </span> Add New Product
            </a>
        </li>
        </ul> --}}

        {{-- Orders --}}
        <a href="{{ route('admin.orders') }}"
            class="menu-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <span class="material-icons-sharp"> shopping_cart </span>
            <h3>Orders</h3>
        </a>
        <a href="{{ route('admin.coupons.index') }}"
            class="menu-item {{ request()->is('admin/admin/coupons*') ? 'active' : '' }}">
            <span class="material-icons-sharp"> local_offer </span>
            <h3>Coupons</h3>
        </a>

        <a href="" class="menu-item">
            <span class="material-icons-sharp"> attach_money </span>
            <h3>Payments</h3>
        </a>
        <a href="" class="menu-item">
            <span class="material-icons-sharp"> groups </span>
            <h3>Customers</h3>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <a href="#" class="menu-item" onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </form>

        {{-- Payments --}}
        {{-- <a href="" class="menu-item">
            <span class="material-icons-sharp"> attach_money </span>
            <h3>Payments</h3>
        </a> --}}

        {{-- Customers --}}
        {{-- <a href="#" class="menu-item">
            <span class="material-icons-sharp"> groups </span>
            <h3>Customers</h3>
        </a> --}}

        {{-- Role --}}
        {{-- <a href="#" class="menu-item">
            <span class="material-icons-sharp"> lock </span>
            <h3>Role</h3>
            <i class="fas fa-chevron-right icon"></i>
        </a> --}}

        {{-- Logout --}}
        {{-- <a href="#" class="menu-item layout">
            <span class="material-icons-sharp"> logout </span>
            <h3>Logout</h3>
        </a> --}}
    </div>
</aside>