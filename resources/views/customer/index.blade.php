@extends('template.customer')

@section('content')
<header class="masthead text-white text-center bg-product">
    <div class="masthead-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                @if($currentCategory != [])
                <h1>{{ $currentCategory->name }}</h1>
                @else
                <h1>สินค้าทั้งหมด</h1>
                @endif
            </div>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 form-group">
                <div class="card" id="category-product">
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_1">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <h6>ประเภทสินค้า</h6>
                            </a>
                        </header>
                        <div class="filter-content show collapse" id="collapse_1">
                            <div class="card-body">
                                {!! Form::open(['method' => 'post', 'url' => 'customer/products/search']) !!}
                                <div class="input-group mr-auto form-group" id="search-product">
                                    @if ($search != "")
                                    <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหา...">
                                    @else
                                    <input name="query" type="text" class="form-control" placeholder="ค้นหา...">
                                    @endif
                                    <div class="input-group-append">
                                        <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                                <ul class="list-menu">
                                    <li>
                                        <a href="{{ url('customer/products') }}">ทั้งหมด</a>
                                    </li>
                                    @foreach($categories as $key => $category)
                                    <li>
                                        <a href="{{ url('customer/products?category='.$key) }}">{{ $category }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
                <div id="category-product-xs" class="form-group">
                    {!! Form::open(['method' => 'post', 'url' => 'customer/products/search']) !!}
                    <div class="input-group mr-auto form-group" id="search-product">
                        @if ($search != "")
                        <input name="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหา...">
                        @else
                        <input name="query" type="text" class="form-control" placeholder="ค้นหา...">
                        @endif
                        <div class="input-group-append">
                            <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <select id="select-product-category" class="select-product-category" style="width: 100%" onchange="location = this.value;">
                        <option value="">เลือกประเภทสินค้า</option>
                        <option value="{{ url('customer/products') }}">สินค้าทั้งหมด</option>
                        @foreach($categories as $key => $category)
                            <option value="{{ url('customer/products?category='.$key) }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </aside>
            <main class="col-lg-9 form-group">
                <header class="section-heading">
                    <h3 class="section-title">
                        @if($currentCategory != [])
                            {{ $currentCategory->name }}
                        @elseif($search != "")
                            ค้นหา : "{{ $search }}"
                        @else
                            สินค้าทั้งหมด
                        @endif
                    </h3>
                </header>
                <div class="row">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            @include('customer._productCard', $product)
                        @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="text-center">
                            <img class="search-no-result-img" src="{{ url('img/no-result.png') }}">
                            <h5>ไม่พบข้อมูล</h5>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 pagination-wrapper" style="justify-content: center; align-items: center;">
                        {{ $products->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

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
<script>
    $('.select-product-category').select2();
</script>
<!--
    foreach ($products as $product)
    <script>
        $("#{ $product->slug }").click(function(e) {
            e.preventDefault();
            $("#{ $product->slug }").html("<span class='spinner-border spinner-border-sm'></span> Loading...");

            $.ajax({
                type: "post",
                url: "{ url('customer/cart') }",
                data: {
                    "_token": "{ csrf_token() }",
                    "product_id": "{ $product->slug }",
                    "customer_id": "{ auth()->guard('customer')->user() ? auth()->guard('customer')->user()->slug: '' }"
                },
                success: function(result) {
                    $('#productCount').text(result.productCount);
                    $("#{ $product->slug }").text("เพิ่มใส่ตระกร้า");
                },
                error: function(result) {
                    alert('error');
                    $("#{ $product->slug }").text("เพิ่มใส่ตระกร้า");
                }
            });
        });
    </script>
    endforeach
-->
@endsection
