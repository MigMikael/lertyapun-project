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
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="margin-bottom: 2rem !important;">
                    <nav style="background: transparent !important;">
                        <ol class="breadcrumb" style="padding-left: 0px;">
                            <li class="breadcrumb-item">
                                สินค้า
                            </li>
                            <li class="breadcrumb-item">
                                @for($i = 0; $i < count($productCategoryText); $i++)
                                    {{ $productCategoryText[$i] }} 
                                    @if($i != count($productCategoryText) - 1)
                                    ,
                                    @endif
                                @endfor
                            </li>
                            <li class="breadcrumb-item">
                                {{ $productNameText }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 form-group">
                <div class="product-image-card form-group">
                    <div class="product-image">
                        <img src="{{ url('image/show/'.$product->image->slug) }}" style="width: 100%;">
                    </div>
                </div>
                <!--
                <div id="aniimated-thumbnials" class="row" style="margin-top: 30px;">
                    @foreach($productImages as $productImage)
                    <a class="col-xs-4 col-md-4 col-lg-2 form-group" href="{{ url('image/show/'.$productImage->slug) }}">
                        <img src="{{ url('image/show/'.$productImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $product->name }}">
                    </a>
                    @endforeach
                </div>
                <div class="owl-carousel owl-theme" id="lightgallery">
                    @foreach($productImages as $productImage)
                    <a class="item" data-src="{{ url('image/show/'.$productImage->slug) }}">
                        <img src="{{ url('image/show/'.$productImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $product->name }}">
                    </a>
                    @endforeach
                </div>
                -->
            </div>
            <div class="col-md-7 form-group">
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
                    <div class="product-expired">
                        <div class="row">
                            <div class="col-md-12">
                                <label>วันหมดอายุ: (วัน/เดือน/ปี)</label>
                                <p>{{ \Carbon\Carbon::parse($product->expired_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @if(count($product->promotions) != 0)
                    <div class="product-promotion">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>โปรโมชัน:</label><br>
                                    @foreach ($product->promotions->reverse() as $promotion)
                                    <span class="badge badge-danger" style="font-weight: normal;">
                                        ลด {{ $promotion->name }}
                                        @if($promotion->type == 'percent')
                                        %
                                        @elseif($promotion->type == 'discount')
                                        บาท
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
                                <!--<select id="unit" name="unit" id="unit" class="form-control" style="width: 300px;">
                                    @foreach($product->units as $productUnit)
                                    <option value="{{ $productUnit->unitName }}">
                                        {{ $productUnit->unitName }}
                                        @if(!$loop->first)
                                        - {{ $productUnit->quantityPerUnit }} {{ $product->units['0']['unitName'] }}
                                        @endif
                                        - <strong>{{ $productUnit->pricePerUnit }}฿</strong>
                                    </option>
                                    @endforeach
                                </select>
                                -->
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
                                        <div style="text-decoration: line-through;">ราคา {{ number_format($productUnit->pricePerUnit, 2) }}
                                            บาท</div>
                                        @if($loop->iteration == 1)
                                        @break
                                        @endif
                                        @endforeach
                                        @else
                                        <div>ราคา {{ number_format($productUnit->pricePerUnit) }} บาท</div>
                                        @endif
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-amount mt-3" style="width: 150px;">
                        <label>จำนวน</label>
                        <input id="quantity" type="number" value="1" min="0" max="{{ $product->quantity }}" step="1"/>
                    </div>
                    <div class="product-remaining">
                        <label style="margin-top: 15px; color: #28a745;">คงเหลือ {{ number_format($product->quantity) }} {{ $product->units['0']['unitName'] }}</label>
                    </div>
                    <div class="buy mt-4">
                        <button class="btn btn-primary mr-3" id="addToCart" @if(auth()->guard('admin')->check()) disabled @endif>
                            <i class="fa fa-shopping-cart"> <span style="font-weight: 300 !important;">เพิ่มใส่รถเข็น</span></i>
                        </button>
                        <!--<button class="btn btn-primary" id="buyProduct">
                            ซื้อสินค้า
                        </button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if (count($similarProducts) != 0)
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>สินค้าที่คล้ายกัน</h5>
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
                                <div style="text-decoration: line-through;">ราคา {{ number_format($similarProduct->units['0']['pricePerUnit'], 2) }} บาท</div>
                                    <span class="badge badge-danger" 
                                    style="font-weight: normal; position: absolute;top: 0;right: 0;margin-top: 7px;margin-right: 7px;">
                                        ลด {{ $promotion->name }}
                                        @if($promotion->type == 'percent')
                                        %
                                        @elseif($promotion->type == 'discount')
                                        บาท
                                        @endif
                                    </span>
                                    @if($loop->iteration == 1)
                                        @break
                                    @endif
                                @endforeach
                            @else
                                <div class="price mt-1">ราคา {{ number_format($similarProduct->units['0']['pricePerUnit']) }} บาท</div>
                            @endif
                            <!--<p>เหลือสินค้า {{ $product->quantity }} ชิ้น</p>-->
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
