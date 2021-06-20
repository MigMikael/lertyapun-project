<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'LERTYAPHAN')</title>

        <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ URL::asset('css/app.css') }}?v=<?=time()?>" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @yield('head')
    </head>
    <body>
        <div class="d-flex" id="wrapper" style="background-color: #e5e5e5">
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">
                    <a href="{{ url('admin') }}" style="color: white;">
                        <img src="{{ URL::asset('img/logo.jpg') }}" style="width: 35px; height: 35px;margin-right: 5px">เลิศยาภัณฑ์
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    {{-- <a href="{{ url('admin/dashboard') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;">Dashboard</a>
                    <a href="{{ url('admin/products') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;">Product</a>
                    <a href="{{ url('admin/promotions') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;">Promotion</a>
                    <a href="{{ url('admin/categories') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;">Category</a>
                    <a href="{{ url('admin/customers') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;">Customer</a>
                    <a href="{{ url('admin/orders') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;">Order</a> --}}

                    <a href="{{ url('admin/dashboard') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-tachometer-alt"></i> แดชบอร์ด</a>
                    <a href="{{ url('admin/customers') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-users"></i> บัญชีผู้ใช้งาน</a>
                    <a href="{{ url('admin/categories') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-th-large"></i> ประเภทสินค้า</a>
                    <a href="{{ url('admin/products') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fab fa-product-hunt"></i> สินค้า</a>
                    <a href="{{ url('admin/promotions') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-percent"></i> โปรโมชัน</a>
                    <a href="{{ url('admin/orders') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-clipboard-list"></i> คำสั่งซื้อ</a>
                    <a href="{{ url('admin/deliveries') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-truck"></i> บริการขนส่ง</a>
                    <a href="{{ url('admin/banks') }}" class="list-group-item list-group-item-action" style="background-color: #2e6bd3; color: white;"><i class="fas fa-university"></i> บัญชีธนาคาร</a>
                </div>
            </div>

            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="menu-toggle">
                            <i class="fa fa-indent"></i>
                        </button>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                {{-- <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li> --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle icon icon-sm" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('customer/products') }}">หน้าสินค้า</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('admin/logout') }}">ออกจากระบบ</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>

        @yield('script')

        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>
