<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Lertyapun')</title>

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        @yield('head')
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">
                    <a href="{{ url('/') }}">Lertyapun</a>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ url('admin/dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                    <a href="{{ url('admin/products') }}" class="list-group-item list-group-item-action bg-light">Product</a>
                    <a href="{{ url('admin/categories') }}" class="list-group-item list-group-item-action bg-light">Category</a>
                    <a href="{{ url('admin/tags') }}" class="list-group-item list-group-item-action bg-light">Promotion (Tag)</a>
                    <a href="{{ url('admin/customers') }}" class="list-group-item list-group-item-action bg-light">Customer</a>
                    <a href="{{ url('admin/orders') }}" class="list-group-item list-group-item-action bg-light">Order</a>
                </div>
            </div>

            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <button class="btn btn-primary" id="menu-toggle">
                        <i class="fa fa-indent"></i>
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
        @yield('script')

        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>
