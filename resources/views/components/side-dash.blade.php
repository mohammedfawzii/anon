<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-Categories" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-menu-button-wide"></i><span>Branch</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-Categories" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('branches.index')}}">
                        <i class="bi bi-circle"></i><span>Branch</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-Product" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-Product" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('products.index')}}">
                        <i class="bi bi-circle"></i><span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('sizes.index')}}">
                        <i class="bi bi-circle"></i><span>Sizes</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('colors.index')}}">
                        <i class="bi bi-circle"></i><span>Color</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-Order" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-Order" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('products.index')}}">
                        <i class="bi bi-circle"></i><span>Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('sizes.index')}}">
                        <i class="bi bi-circle"></i><span>Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('colors.index')}}">
                        <i class="bi bi-circle"></i><span>Returns</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside>
