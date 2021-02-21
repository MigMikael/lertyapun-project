@extends('template.customer')

@section('content')
<section class="section-page-top">
    <div class="container">
        <h2 class="title-page">ตะกร้าสินค้า</h2>
    </div>
</section>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <main class="col-sm-12 col-lg-8">
                <div class="card form-group">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="title">รายการสินค้า</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-border table-shopping-cart">
                                        <thead>
                                            <tr>
                                                <th>
                                                    สินค้า
                                                </th>
                                                <th width="160">
                                                    ราคา
                                                </th>
                                                <th width="110">
                                                    จำนวน
                                                </th>
                                                <th class="text-right">
                                                    ลบ
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer->cart as $product)
                                            <tr id="product-table">
                                                <td class="align-middle">
                                                    <figure class="itemside">
                                                        <div class="aside">
                                                            <img class="img-sm" src="{{ url('image/thumbnail/'.$product->image->slug) }}">
                                                        </div>
                                                        <figcaption class="info">
                                                            <a href="{{ url('customer/products/'.$product->slug) }}" class="title text-dark">
                                                                <p>{{ $product->name }}</p>
                                                                @foreach ($product->promotions->reverse() as $promotion)
                                                                    <span class="badge badge-danger" style="font-weight: normal">{{ $promotion->name }}</span>
                                                                    @if($loop->iteration == 1)
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </a>
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td id="price" class="align-middle">
                                                    @if($product->has_discount)<del>@endif
                                                    <h6>฿<span id="base_price">{{ number_format($product->price) }}</span> ต่อ{{ $product->unit }}</h6>
                                                    @if($product->has_discount)</del>@endif

                                                    @if($product->has_discount)
                                                    <h6 style="color: red">฿<span id="discount_price" >{{ number_format($product->discount_price, 2) }}</span></h6>
                                                    @else
                                                    <h6 style="display: none">฿<span id="discount_price" >{{ number_format($product->discount_price, 2) }}</span></h6>
                                                    @endif
                                                </td>
                                                <td id="quantity" class="align-middle">
                                                    <input id="input_quantity"
                                                        type="number" class="form-control"
                                                        value="{{ $product->pivot->quantity }}"
                                                        min="1"
                                                        max="{{ $product->quantity }}"
                                                        style="width: 80px;">
                                                    <input id="product_slug" type="hidden" value="{{ $product->slug }}">
                                                    <p>เหลือ {{ $product->quantity }} ชิ้น</p>
                                                </td>
                                                <td class="text-right align-middle">
                                                    {!! Form::model($product, [
                                                        'method' => 'delete',
                                                        'url' => 'customer/cart/'.$product->slug ]) !!}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <aside class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5 class="title">รวมยอดชำระเงิน</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ยอดรวมสินค้า</label>
                            </div>
                            <div class="col-md-6 text-right">
                                ฿<span id="total_price">{{ number_format($customer->totalPrice) }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ส่วนลด</label>
                            </div>
                            <div class="col-md-6 text-right">
                                ฿<span id="total_discount">{{ number_format($customer->totalDiscount) }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ยอดชำระเงินทั้งหมด</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5>฿<span id="final_price">{{ number_format($customer->finalPrice) }}<span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="order_submit" type="submit" class="btn btn-primary btn-block">ยืนยันการสั่งซื้อ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $(document).on('input', '#quantity', function() {
            var prices = [];
            var discountPrices = [];
            var quantities = [];

            $("#product-table #price #base_price").each(function() {
                var value = $(this).text();
                prices.push(value.replace(',', ''));
            });

            $("#product-table #price #discount_price").each(function() {
                var value = $(this).text();
                discountPrices.push(value.replace(',', ''));
            });

            $("#product-table #quantity #input_quantity").each(function() {
                var value = $(this).val();
                quantities.push(value.replace(',', ''));
            })

            var totalPrice = 0;
            var totalDiscount = 0;
            for (let i = 0; i < prices.length; i++) {
                var price = parseFloat(prices[i]);
                var quantity = parseFloat(quantities[i]);
                var discountPrice = parseFloat(discountPrices[i]);

                var productPrice = price * quantity;
                totalPrice += productPrice;

                var discount = (price - discountPrice) * quantity;
                totalDiscount += discount;
            }
            var finalPrice = totalPrice - totalDiscount;

            $("#total_price").text(totalPrice.toLocaleString());
            $("#total_discount").text(totalDiscount.toLocaleString());
            $("#final_price").text(finalPrice.toLocaleString());
        });
    </script>
    <script>
        $("#order_submit").click(function(e) {
            e.preventDefault();
            $("#order_submit").html("<span class='spinner-border spinner-border-sm'></span> Loading...");

            var productSlug = [];
            var productQuantity = [];

            $("#product-table #quantity #input_quantity").each(function() {
                var value = $(this).val();
                productQuantity.push(value.replace(',', ''));
            });

            $("#product-table #quantity #product_slug").each(function() {
                var value = $(this).val();
                productSlug.push(value.replace(',', ''));
            });

            $.ajax({
                type: "post",
                url: "{{ url('customer/order') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "product_slug": productSlug,
                    "product_quantity": productQuantity
                },
                success: function(result) {
                    console.log('success', result);
                    window.location.replace("{{ url('customer/order') }}");
                },
                error: function(result) {
                    console.log('error', result);
                }
            });
        });
    </script>
@endsection
