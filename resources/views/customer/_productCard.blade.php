<div class="col-lg-3">
    <div class="card card-product-grid">
        <a href="{{ url('customer/products/'.$product->slug) }}" class="img-wrap">
            <img src="{{ url('image/show/'.$product->image->slug) }}">
        </a>
        <figcaption class="info-wrap">
            <div class="fix-height">
                <div class="title">
                    <div class="text-ellipsis">
                        {{ $product->name }}
                    </div>
                </div>
                @if(count($product->promotions) != 0)
                    @foreach ($product->promotions->reverse() as $promotion)
                    <div class="price mt-1">ราคา {{ number_format(doubleval($product->units['0']['pricePerUnit']) - doubleval($promotion->name), 2) }} บาท</div>
                    @if ($promotion->name != "0")
                        <div style="text-decoration: line-through;">ราคา {{ number_format($product->units['0']['pricePerUnit'], 2) }} บาท</div>
                    @endif
                    <span class="badge badge-danger" style="font-weight: normal; position: absolute;top: 0;right: 0;margin-top: 7px;margin-right: 7px;">
                        @if ($promotion->name != "0")
                        ลด {{ $promotion->name }}
                        @if($promotion->type == 'percent')
                        %
                        @elseif($promotion->type == 'discount')
                        บาท
                        @endif
                        @else
                        ราคาพิเศษ
                        @endif
                    </span>
                    @if($loop->iteration == 1)
                        @break
                    @endif
                    @endforeach
                @else
                    <div class="price mt-1">ราคา {{ number_format($product->units['0']['pricePerUnit'], 2) }} บาท</div>
                @endif
                <!--<p>เหลือสินค้า {{ $product->quantity }} ชิ้น</p>-->
            </div>
            @if($product->quantity <= 0)
            <button class="btn btn-block btn-danger mt-3" style="cursor: unset !important;">
                สินค้าหมด
            </button>
            @else
            <button class="btn btn-block btn-primary mt-3 addToCart" data-product_id="{{ $product->slug }}" data-product_name="{{ $product->name }}" data-product_unit="{{ $product->units['0']->unitName }}" 
            @if(auth()->guard('admin')->check()) disabled @endif>
                เพิ่มใส่รถเข็น
            </button>
            @endif
            <a id="{{ $product->slug }}" href="{{ url('customer/products/'.$product->slug) }}" class="btn btn-block btn-secondary mt-3"
                @if(auth()->guard('admin')->check())
                    disabled
                @endif
                >
                ดูรายละเอียด
            </a>
        </figcaption>
    </div>
</div>

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(".addToCart").each(function(index) {
    $(this).on("click", function(){
        $(".addToCart").html("<span class='spinner-border spinner-border-sm'></span> Loading...");
        var product_id = $(this).data("product_id");
        var product_name = $(this).data("product_name");
        var product_unit = $(this).data("product_unit");
        $.ajax({
            type: "post",
            url: "{{ url('customer/cart') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "product_id": product_id,
                "customer_id": "{{ auth()->guard('customer')->user()? auth()->guard('customer')->user()->slug : '' }}",
                "quantity": 1,
                "unit": product_unit,
            },
            success: function(result) {
                $('#productCount').text(result.productCount);
                $(".addToCart").html("<i class='fa fa-shopping-cart'> <span style='font-weight: 300 !important;'>เพิ่มใส่รถเข็น</span></i>");
                Swal.fire(
                    'สำเร็จ !',
                    'คุณได้เพิ่ม ' + product_name + ' <br> ใส่รถเข็นสำเร็จแล้ว !',
                    'success'
                )},
            error: function(result) {
                $(".addToCart").html("<i class='fa fa-shopping-cart'> <span style='font-weight: 300 !important;'>เพิ่มใส่รถเข็น</span></i>");
                $("#errorModal .modal-dialog .modal-content #title").html("เกิดข้อผิดพลาด...");
                $("#errorModal .modal-dialog .modal-content #message").html(result.responseJSON.errors);
                $('#errorModal').modal('show');
            }});
        });
    });
</script>
@endsection
