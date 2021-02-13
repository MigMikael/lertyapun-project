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
                    <div class="product-amount mt-3">
                        <label>จำนวน</label>
                        <input type="number" class="form-control" value="1" style="width: 100px;">
                    </div>
                    <div class="buy mt-4">
                        <a href="shopping_cart.html" class="btn btn-secondary mr-3">
                            <i class="fa fa-shopping-cart">เพิ่มใส่ตระกร้า</i>
                        </a>
                        <button class="btn btn-primary">
                            ซื้อสินค้า
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
