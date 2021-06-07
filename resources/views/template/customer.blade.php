<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" CONTENT="เลิศยาภัณฑ์, ร้านขายยา, ร้านยา, ร้านยาราคาถูก, ร้านยาคุณภาพ, ร้านยาปลีก-ส่ง, ร้านยาโดยเภสัชกร, ร้านยาเภสัช">
        <meta name="description" content="เลิศยาภัณฑ์ ร้านยาคุณภาพ ราคาถูก ปลีก-ส่ง พร้อมบริการปรึกษาปัญหาทางสุขภาพและมีกิจกรรมตรวจสุขภาพฟรีตลอดทั้งปี">
        <meta name="author" content="เลิศยาภัณฑ์">

        <title>@yield('title', 'LERTYAPHAN')</title>

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
        <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
        <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ URL::asset('vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
        <link href="{{ URL::asset('css/landing-page.css') }}?v=<?=time()?>" type="text/css" rel="stylesheet">
        <link href="{{ URL::asset('css/app.css') }}?v=<?=time()?>" type="text/css" rel="stylesheet">
        <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>

        @yield('head')
    </head>
    <body>
        @if(auth()->guard('customer')->check() || auth()->guard('admin')->check())
        @include('template._navbar')
        @else
        <nav class="navbar navbar-light static-top" style="border-bottom: 1px solid #DEDEDE !important;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('img/logo.jpg') }}" style="width: 60px; height: 60px;">
                </a>
                <a class="btn btn-md btn-secondary" href="{{ url('login') }}">เข้าสู่ระบบ</a>
            </div>
        </nav>
        @endif

        @include('customer._errorModal')
        @yield('content')
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $( document ).ready(function(){
                $.ajax({
                    url: '{{ url("customer/cart/product/count") }}',
                    type: 'get',
                    success: function(result) {
                        console.log('result', result)
                        $('#productCount').text(result.productCount);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var errorMsg = 'request failed: ' + xhr.responseText;
                        $('#content').html(errorMsg);
                    }
                });
            });
        </script>
        <script>
        $("#user-menu-toggle").click(function(){
            $("#sidebar").toggle(200);
        });
        </script>
        @yield('script')
    </body>
</html>
