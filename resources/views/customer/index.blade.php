@extends('template.customer')

@section('content')
<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1>BANNER</h1>
            </div>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <aside class="col-md-4 col-lg-3 form-group">
                <div class="card">
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_1">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <h6>ประเภทสินค้า</h6>
                            </a>
                        </header>
                        <div class="filter-content show collapse" id="collapse_1">
                            <div class="card-body">
                                <div class="input-group mr-auto form-group" id="search-product">
                                    <input type="text" class="form-control" placeholder="ค้นหา...">
                                    <div class="input-group-append">
                                        <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
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
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_2">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <h6>ราคา</h6>
                            </a>
                        </header>
                        <div class="filter-content show collapse" id="collapse_2">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>ต่ำสุด</label>
                                        <input type="number" class="form-control" placeholder="0" min="0"
                                            max="5000">
                                    </div>
                                    <div class="form-group text-right col-md-6">
                                        <label>สูงสุด</label>
                                        <input type="number" class="form-control" placeholder="5000" min="0"
                                            max="5000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="filter-group">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary btn-block">ค้นหา</button>
                        </div>
                    </article>
                </div>
            </aside>
            <main class="col-md-8 col-lg-9 form-group">
                <header class="section-heading">
                    <h3 class="section-title">
                        @if($currentCategory != [])
                            {{ $currentCategory->name }}
                        @else
                            สินค้าทั้งหมด
                        @endif
                    </h3>
                </header>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-product-grid">
                            <a href="{{ url('customer/products/'.$product->slug) }}" class="img-wrap">
                                <img src="{{ url('image/show/'.$product->image->slug) }}">
                            </a>
                            <figcaption class="info-wrap">
                                <div class="fix-height">
                                    <a href="{{ url('customer/products/'.$product->slug) }}" class="title">
                                        {{ $product->name }}
                                    </a>
                                    <div class="price mt-1">฿{{ $product->price }}</div>
                                </div>
                                <a href="shopping_cart.html" class="btn btn-block btn-primary">เพิ่มใส่ตระกร้า</a>
                            </figcaption>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12" style="justify-content: center; align-items: center">
                        {{ $products->render("pagination::bootstrap-4") }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
@endsection
