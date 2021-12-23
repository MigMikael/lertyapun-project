<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-expand-md static-top" style="border-bottom: 1px solid #DEDEDE !important;">
    <div class="container">
        @if (\Request::is('customer/profile') || \Request::is('customer/document') || \Request::is('customer/address') || \Request::is('customer/password') || \Request::is('customer/order')) 
        <button class="btn btn-primary" id="user-menu-toggle">
            <i class="fa fa-indent"></i>
        </button>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('img/logo.jpg') }}" style="width: 60px; height: 60px;">
            </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('customer/products') }}">สินค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('customer/products/promotions') }}">โปรโมชัน</a>
                </li>
            </ul>
            @if(auth()->guard('customer')->check())
                <div class="widget-header mr-3">
                    <a href="{{ url('customer/cart') }}" class="icon icon-sm rounded-circle border">
                        <i class="fa fa-shopping-cart"></i>
                        <span id="productCount" class="badge badge-pill badge-danger notify"></span>
                    </a>
                </div>
            @endif
            <div class="btn-group">
                <a href="#" class="icon icon-sm rounded-circle border" data-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu">
                    @if(auth()->guard('customer')->check())
                        <a class="dropdown-item" href="{{ url('customer/profile') }}">บัญชีของฉัน</a>
                        <div class="dropdown-divider"></div>
                    @elseif(auth()->guard('admin')->check())
                        <a class="dropdown-item" href="{{ url('admin') }}">หน้าแอดมิน</a>
                        <div class="dropdown-divider"></div>
                    @endif
                    @if(auth()->guard('customer')->check())
                        <a class="dropdown-item" href="{{ url('customer/order') }}">การซื้อของฉัน</a>
                        <div class="dropdown-divider"></div>
                    @endif
                    @if(auth()->guard('customer')->check())
                        <a class="dropdown-item" href="{{ url('customer/logout') }}">ออกจากระบบ</a>
                    @elseif(auth()->guard('admin')->check())
                        <a class="dropdown-item" href="{{ url('admin/logout') }}">ออกจากระบบ</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
