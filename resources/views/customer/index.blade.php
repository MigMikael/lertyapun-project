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
            <div class="col-lg-12 form-group">
                {!! Form::open(['method' => 'post', 'url' => 'customer/products/search', 'id' => 'search-product-form']) !!}
                <div class="row">
                    <div class="col-md-4 form-group">
                        <select class="form-control select-product-category" name="category" style="width: 100%;">
                            <option value="all">สินค้าทั้งหมด</option>
                            @foreach($categories as $key => $category)
                            @if ($currentCategorySlug == $key)
                            <option value="{{ $key }}" selected>{{ $category }}</option>
                            @else
                            <option value="{{ $key }}">{{ $category }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 form-group">
                        <div class="input-group">
                        @if (isset($search) && $search != "")
                        <input name="query" id="query" value="{{ $search }}" type="text" class="form-control" placeholder="ค้นหาสินค้า...">
                        @else
                        <input name="query" id="query" type="text" class="form-control" placeholder="ค้นหาสินค้า...">
                        @endif
                        <div class="input-group-append">
                            <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <main class="col-lg-12 form-group">
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
                        <!--{{ $products->render("pagination::bootstrap-4") }}-->
                        <!--{{ $products->appends(['query' => $search, 'category' => $currentCategory])->links("pagination::bootstrap-4") }}-->
                        {{ $products->withQueryString()->links("pagination::bootstrap-4") }}
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
@endsection
