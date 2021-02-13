<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-expand-md static-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('img/logo.jpg') }}" style="width: 60px; height: 60px;">
                เลิศยาภัณฑ์
            </a>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ URL::asset('customer/products') }}">สินค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::asset('customer/products/promotions') }}">โปรโมชัน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::asset('customer/services') }}">บริการลูกค้า</a>
                </li>
            </ul>
            <div class="input-group mr-auto" id="search-nav">
                <input type="text" class="form-control" placeholder="ค้นหา...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="widget-header mr-3">
                <a href="shopping_cart.html" class="icon icon-sm rounded-circle border">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge badge-pill badge-danger notify">1</span>
                </a>
            </div>
            <div class="btn-group">
                <a href="#" class="icon icon-sm rounded-circle border" data-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.html">บัญชีของฉัน</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="purchase.html">การซื้อของฉัน</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>
</nav>
