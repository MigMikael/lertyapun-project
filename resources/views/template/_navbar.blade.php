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
                    <a class="nav-link" href="{{ url('customer/products') }}">สินค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('customer/products/promotions') }}">โปรโมชัน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('customer/services') }}">บริการลูกค้า</a>
                </li>
            </ul>
            {!! Form::open(['method' => 'post', 'url' => 'customer/products/search', 'class' => 'input-group mr-auto', 'id' => 'search-nav']) !!}
                @if (isset($search) && $search != "")
                <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหา...">
                @else
                <input name="query" type="text" class="form-control" placeholder="ค้นหา...">
                @endif
                <div class="input-group-append">
                    <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                </div>
            {!! Form::close() !!}

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
                    @elseif(auth()->guard('admin')->check())
                        <a class="dropdown-item" href="{{ url('admin') }}">หน้าแอดมิน</a>
                    @endif

                    <div class="dropdown-divider"></div>
                    @if(auth()->guard('customer')->check())
                        <a class="dropdown-item" href="{{ url('customer/order') }}">การซื้อของฉัน</a>
                    @endif
                    <div class="dropdown-divider"></div>

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
