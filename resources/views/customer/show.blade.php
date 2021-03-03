@extends('template.customer')

@section('content')
<section class="section-page-top">
    <div class="container">
        <h2 class="title-page">สินค้า</h2>
    </div>
</section>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="product-image-card">
                    <div class="product-image">
                        <img src="{{ url('image/show/'.$product->image->slug) }}" style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="product-card">
                    <div class="product-name">
                        <h1>{{ $product->name }}</h1>
                    </div>
                    <div class="product-info mt-3">
                        <label>รายละเอียดสินค้า</label>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="product-price mt-3">
                        <label>ราคา</label>
                        <h5 class="price">฿{{ $product->price }} {{ $product->unit }}</h5>
                    </div>
                    <div class="mt-3">
                        @foreach ($product->promotions as $promotion)
                            <span class="badge badge-danger" style="font-weight: normal">{{ $promotion->name }}</span>
                        @endforeach
                    </div>
                    <div class="product-amount mt-3">
                        <label>จำนวน</label>
                        <input id="quantity" type="number" class="form-control" value="1" style="width: 100px;">
                        <p>เหลือสินค้า {{ $product->quantity }} ชิ้น</p>
                    </div>
                    <div class="buy mt-4">
                        <button class="btn btn-secondary mr-3" id="addToCart">
                            <i class="fa fa-shopping-cart">เพิ่มใส่ตระกร้า</i>
                        </button>
                        <button class="btn btn-primary" id="buyProduct">
                            ซื้อสินค้า
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $("#buyProduct").click(function(e) {
        e.preventDefault();
        $("#buyProduct").html("<span class='spinner-border spinner-border-sm'></span> Loading...");

        $.ajax({
            type: "post",
            url: "{{ url('customer/cart') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "product_id": "{{ $product->slug }}",
                "customer_id": "{{ auth()->guard('customer')->user()->slug }}",
                "quantity": $("#quantity").val(),
            },
            success: function(result) {
                $('#productCount').text(result.productCount);
                $("#buyProduct").text("ซื้อสินค้า");
                window.location.href("{{ url('customer/cart') }}");
            },
            error: function(result) {
                $("#buyProduct").text("ซื้อสินค้า");
                $("#errorModal .modal-dialog .modal-content #title").html("เกิดข้อผิดพลาด...");
                $("#errorModal .modal-dialog .modal-content #message").html(result.responseJSON.errors);
                $('#errorModal').modal('show');
            }
        });
    })
</script>
<script>
    $("#addToCart").click(function(e) {
        e.preventDefault();
        $("#addToCart").html("<span class='spinner-border spinner-border-sm'></span> Loading...");

        $.ajax({
            type: "post",
            url: "{{ url('customer/cart') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "product_id": "{{ $product->slug }}",
                "customer_id": "{{ auth()->guard('customer')->user()->slug }}",
                "quantity": $("#quantity").val(),
            },
            success: function(result) {
                $('#productCount').text(result.productCount);
                $("#addToCart").html("<i class='fa fa-shopping-cart'>เพิ่มใส่ตระกร้า</i>");
            },
            error: function(result) {
                $("#addToCart").html("<i class='fa fa-shopping-cart'>เพิ่มใส่ตระกร้า</i>");
                $("#errorModal .modal-dialog .modal-content #title").html("เกิดข้อผิดพลาด...");
                $("#errorModal .modal-dialog .modal-content #message").html(result.responseJSON.errors);
                $('#errorModal').modal('show');
            }
        });
    })
</script>
@endsection
