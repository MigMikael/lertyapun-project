@extends('template.customer')

@section('head')
    <link href="{{ URL::asset('css/lightgallery.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.css" integrity="sha512-riTSV+/RKaiReucjeDW+Id3WlRLVZlTKAJJOHejihLiYHdGaHV7lxWaCfAvUR0ErLYvxTePZpuKZbrTbwpyG9w==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"></script>
@endsection

@section('content')
<section class="breadcrumb-wrapper" style="padding-top: 50px !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <nav style="background: transparent !important;">
                        <ol class="breadcrumb" style="padding-left: 0px; font-weight: 400;">
                            <li class="breadcrumb-item">
                                <a href="{{ url('customer/products') }}">สินค้า</a>
                            </li>
                            <li class="breadcrumb-item">
                                @for($i = 0; $i < count($productCategoryText); $i++)
                                    <a href="{{ url('customer/products?category='.$productCategoryId[$i]) }}">{{ $productCategoryText[$i] }}</a>
                                    @if($i != count($productCategoryText) - 1)
                                    , 
                                    @endif
                                @endfor
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('customer/products/'.$product->slug) }}">{{ $productNameText }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="padding: 0;">
    <div class="container">
        <div class="row" style="background: #FFF; padding: 25px; margin: 0px; border: 1px solid rgba(0,0,0,.125); border-radius: .25rem;">
            <div class="col-md-6 form-group">
                <div class="product-image-card form-group zoom">
                    <div class="product-image original">
                        <img src="{{ url('image/show/'.$product->image->slug) }}" style="width: 100%;" id="target">
                    </div>
                      <!-- Large Image -->
  <div class="viewer">
    <img src="{{ url('image/show/'.$product->image->slug) }}">
  </div>
  <!-- Magnifier Effect -->
  <div class="magnifier"></div>
                </div> 
            </div>
            <div class="col-md-6 form-group">
                <div class="product-card">
                    <div class="product-name">
                        <div class="form-group">
                            <h4>{{ $product->name }}</h4>
                        </div>
                    </div>
                    <div class="product-info">
                        <label>รายละเอียดสินค้า</label>
                        @if ($product->description == "" || $product->description == null)
                        <p>-</p>
                        @else
                        <p>{{ $product->description }}</p>
                        @endif
                    </div>
                    <div class="product-company">
                        <label>บริษัท (แบรนด์)</label>
                        @if ($product->company_name == "" || $product->company_name == null)
                        <p>-</p>
                        @else
                        <p>{{ $product->company_name }}</p>
                        @endif
                    </div>
                    <!--
                    <div class="product-expired">
                        <div class="row">
                            <div class="col-md-12">
                                <label>วันหมดอายุ: (วัน/เดือน/ปี)</label>
                                <p>{{ \Carbon\Carbon::parse($product->expired_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                    -->
                    @if(count($product->promotions) != 0)
                    <div class="product-promotion">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>โปรโมชัน:</label><br>
                                    @foreach ($product->promotions->reverse() as $promotion)
                                    <span class="badge badge-danger" style="font-weight: normal;">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="product-price">
                        <div class="row">
                            <div class="col-md-12">
                                <label>ราคา</label>
                                <div class="radio-toolbar">
                                    @foreach($product->units as $productUnit)
                                    <input type="radio" id="{{ $productUnit->unitName }}" id="unit" name="unit" value="{{ $productUnit->unitName }}">
                                    <label for="{{ $productUnit->unitName }}">
                                        {{ $productUnit->unitName }}
                                        @if(!$loop->first)
                                        : {{ $productUnit->quantityPerUnit }} {{ $product->units['0']['unitName'] }}
                                        @endif
                                        @if(count($product->promotions) != 0)
                                        @foreach ($product->promotions->reverse() as $promotion)
                                        <div>ราคา
                                            {{ number_format(doubleval($productUnit->pricePerUnit) - doubleval($promotion->name), 2) }} บาท
                                        </div>
                                        @if ($promotion->name != "0")
                                        <div style="text-decoration: line-through;">ราคา {{ number_format($productUnit->pricePerUnit, 2) }}
                                            บาท</div>
                                        @endif
                                        @if($loop->iteration == 1)
                                        @break
                                        @endif
                                        @endforeach
                                        @else
                                        <div>ราคา {{ number_format($productUnit->pricePerUnit, 2) }} บาท</div>
                                        @endif
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($product->quantity > 0)
                    <div class="product-amount mt-3" style="width: 150px;">
                        <label>จำนวน</label>
                        <input id="quantity" type="number" value="1" min="0" max="{{ $product->quantity }}" step="1"/>
                    </div>
                    @endif
                    <!--
                    <div class="product-remaining">
                        <label style="margin-top: 15px; color: #28a745;">คงเหลือ {{ number_format($product->quantity) }} {{ $product->units['0']['unitName'] }}</label>
                    </div>
                    -->
                    @if ($product->quantity > 0)
                    <div class="buy mt-4">
                        <button class="btn btn-primary mr-3" id="addToCart" @if(auth()->guard('admin')->check()) disabled @endif>
                            <i class="fa fa-shopping-cart"> <span style="font-weight: 300 !important;">เพิ่มใส่รถเข็น</span></i>
                        </button>
                    </div>
                    @else
                    <div class="buy mt-4">
                        <label style="color: red;">สินค้าหมด</label>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@if (count($similarProducts) != 0)
<section style="padding-top: 45px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>สินค้าแนะนำ</h5>
                </div>
            </div>
            @foreach ($similarProducts as $similarProduct)
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="card card-product-grid">
                    <a href="{{ url('customer/products/'.$similarProduct->slug) }}" class="img-wrap">
                        <img src="{{ url('image/show/'.$similarProduct->image->slug) }}">
                    </a>
                    <figcaption class="info-wrap">
                        <div class="fix-height">
                            <a href="{{ url('customer/products/'.$similarProduct->slug) }}" class="title">
                                <div class="text-ellipsis">
                                    {{ $similarProduct->name }}
                                </div>
                            </a>
                            @if(count($similarProduct->promotions) != 0)
                                @foreach ($similarProduct->promotions->reverse() as $promotion)
                                <div class="price mt-1">ราคา {{ number_format(doubleval($similarProduct->units['0']['pricePerUnit']) - doubleval($promotion->name), 2) }} บาท</div>
                                @if ($promotion->name != "0")
                                    <div style="text-decoration: line-through;">ราคา {{ number_format($similarProduct->units['0']['pricePerUnit'], 2) }} บาท</div>
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
                                <div class="price mt-1">ราคา {{ number_format($similarProduct->units['0']['pricePerUnit'], 2) }} บาท</div>
                            @endif
                        </div>
                        <a id="{{ $similarProduct->slug }}"
                            @if($similarProduct->quantity <= 0)
                                href="#" class="btn btn-block btn-secondary mt-3" disabled
                            @else
                                href="{{ url('customer/products/'.$similarProduct->slug) }}" class="btn btn-block btn-primary mt-3"
                            @endif
            
                            @if(auth()->guard('admin')->check())
                                disabled
                            @endif
                            >
                                @if($similarProduct->quantity <= 0)
                                สินค้าหมด
                                @else
                                ดูรายละเอียด
                                @endif
                        </a>
                    </figcaption>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
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

@section('script')
<script src="{{ URL::asset('vendor/bootstrap/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ URL::asset('js/zoom.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $("input[type='number']").inputSpinner()
    $('input[name="unit"]').first().prop('checked', true)
</script>
<script>
    $('#lightgallery').lightGallery({
        selector: '.item',
        thumbnail: true
    })

    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    items: 3
})
</script>
<script>
    $('#target').zoom(2);
</script>
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
                "customer_id": "{{ auth()->guard('customer')->user()? auth()->guard('customer')->user()->slug : '' }}",
                "quantity": $("#quantity").val(),
                "unit": /*$("#unit").val()*/$('input[name="unit"]:checked').val(),
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
                "customer_id": "{{ auth()->guard('customer')->user()? auth()->guard('customer')->user()->slug : '' }}",
                "quantity": $("#quantity").val(),
                "unit": /*$("#unit").val()*/$('input[name="unit"]:checked').val(),
            },
            success: function(result) {
                $('#productCount').text(result.productCount);
                $("#addToCart").html("<i class='fa fa-shopping-cart'> <span style='font-weight: 300 !important;'>เพิ่มใส่รถเข็น</span></i>");
                Swal.fire(
                    'สำเร็จ !',
                    'คุณเพิ่ม ' + '{{ $product->name }}' + '<br> ใส่รถเข็นสำเร็จแล้ว !',
                    'success'
                )
            },
            error: function(result) {
                $("#addToCart").html("<i class='fa fa-shopping-cart'> <span style='font-weight: 300 !important;'>เพิ่มใส่รถเข็น</span></i>");
                $("#errorModal .modal-dialog .modal-content #title").html("เกิดข้อผิดพลาด...");
                $("#errorModal .modal-dialog .modal-content #message").html(result.responseJSON.errors);
                $('#errorModal').modal('show');
            }
        });
    })
</script>
@endsection
