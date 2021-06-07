@extends('template.customer')

@section('content')
<!-- Masthead -->
<header class="masthead text-white text-center bg-promotion">
    <div class="masthead-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1>โปรโมชันทั้งหมด</h1>
            </div>
        </div>
    </div>
</header>
<section class="bg-white">
    <div class="container">
        <header class="section-heading">
            <h3 class="section-title">โปรโมชัน</h3>
        </header>
        <div class="row">
            @foreach ($products as $product)
                @include('customer._productCard', $product)
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12" style="justify-content: center; align-items: center">
                {{ $products->render("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
</section>
<div class="overlay"></div>
<!-- Footer -->
<footer class="footer bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted text-center" style="margin-top: 5px; margin-bottom: 0px !important;">&copy; LERTYAPHAN 2021. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
@endsection
<!--
section('script')
    @foreach ($products as $product)
    <script>
        $("#{{ $product->slug }}").click(function(e) {
            e.preventDefault();
            $("#{{ $product->slug }}").html("<span class='spinner-border spinner-border-sm'></span> Loading...");

            $.ajax({
                type: "post",
                url: "{{ url('customer/cart') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "product_id": "{{ $product->slug }}",
                    "customer_id": "{{ auth()->guard('customer')->user() ? auth()->guard('customer')->user()->slug : '' }}"
                },
                success: function(result) {
                    $('#productCount').text(result.productCount);
                    $("#{{ $product->slug }}").text("เพิ่มใส่ตระกร้า");
                },
                error: function(result) {
                    alert('error');
                    $("#{{ $product->slug }}").text("เพิ่มใส่ตระกร้า");
                }
            });
        });
    </script>
    @endforeach
endsection
-->
