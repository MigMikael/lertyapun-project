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
                                                <th width="240">
                                                    ราคา
                                                </th>
                                                <th width="120">
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
                                                <td id="name" class="align-middle">
                                                    <figure class="itemside">
                                                        <div class="aside">
                                                            <img class="img-sm" src="{{ url('image/thumbnail/'.$product->image->slug) }}">
                                                        </div>
                                                        <figcaption class="info">
                                                            <a href="{{ url('customer/products/'.$product->slug) }}" class="title text-dark">
                                                                <p>{{ $product->name }}</p>
                                                                @if(count($product->promotions) > 0)
                                                                    @foreach ($product->promotions->reverse() as $promotion)
                                                                        <span class="badge badge-danger" style="font-weight: normal" id="promotion_name">{{ $promotion->name }}</span>
                                                                        @if($loop->iteration == 1)
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <span class="badge badge-danger" style="font-weight: normal; display: none" id="promotion_name">0</span>
                                                                @endif
                                                            </a>
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td id="price" class="align-middle">
                                                    {{-- @if($product->has_discount)<del>@endif
                                                    <h6>฿<span id="base_price">{{ number_format($product->price) }}</span> ต่อ{{ $product->unit }}</h6>
                                                    @if($product->has_discount)</del>@endif

                                                    @if($product->has_discount)
                                                    <h6 style="color: red">฿<span id="discount_price" >{{ number_format($product->discount_price, 2) }}</span></h6>
                                                    @else
                                                    <h6 style="display: none">฿<span id="discount_price" >{{ number_format($product->discount_price, 2) }}</span></h6>
                                                    @endif --}}
                                                    <select id="unit" name="unit" id="unit" class="form-control">
                                                        @foreach($product->units as $productUnit)
                                                        <option value="{{ $productUnit->unitName }};{{ $productUnit->pricePerUnit }}" @if($productUnit->unitName == $product->pivot->unitName)selected="selected"@endif>
                                                            {{ $productUnit->unitName }}
                                                            @if(!$loop->first)
                                                            - {{ $productUnit->quantityPerUnit }} {{ $product->units['0']['unitName'] }}
                                                            @endif
                                                            - <strong>{{ $productUnit->pricePerUnit }}฿</strong>
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <p id="discount_price_container" style="color: red;font-size: 12px">ลดราคาเหลือ <span id="discount_price">0</span>฿</p>
                                                </td>
                                                <td id="quantity" class="align-middle">
                                                    <input id="input_quantity"
                                                        type="number" class="form-control"
                                                        value="{{ $product->pivot->quantity }}"
                                                        min="1"
                                                        max="{{ $product->quantity }}"
                                                        >
                                                    <input id="product_slug" type="hidden" value="{{ $product->slug }}">
                                                    <p style="font-size: 12px">เหลือ {{ number_format($product->quantity) }} {{ $product->units['0']['unitName'] }}</p>
                                                </td>
                                                <td class="text-right align-middle">
                                                    {!! Form::model($product, [
                                                        'method' => 'delete',
                                                        'url' => 'customer/cart/'.$product->slug ]) !!}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <p style="font-size: 12px; color: white">x</p>
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
        function calculateDiscount() {
            var prices = []
            var discounts = []

            $("#product-table #price #unit").each(function() {
                var value = $(this).val()
                price = value.split(';')[1]
                // console.log("value", price)
                prices.push(price.replace(',', ''))
            })

            $("#product-table #name .itemside .info .title #promotion_name").each(function() {
                var value = $(this).text()
                var matches = value.match(/(\d+)/)[0]
                // console.log("matches", matches)
                discounts.push(matches)
            })

            // console.log(prices)
            // console.log(discounts)

            var count = 0
            $("#product-table #price #discount_price").each(function() {
                var price = parseFloat(prices[count])
                var discountPercent = parseFloat(discounts[count])

                var discountMultiply = 1 - (discountPercent / 100)
                var discountPrice = price * discountMultiply
                // console.log(discountPrice)

                if (price == discountPrice) {
                    $(this).parent().css('color', 'white')
                }

                $(this).text(discountPrice.toString())
                count += 1
            })
        }

        function calculatePrice() {
            var prices = []
            var discountPrices = []
            var quantities = []

            $("#product-table #price #unit").each(function() {
                var value = $(this).val()
                price = value.split(';')[1]
                prices.push(price.replace(',', ''))
            })

            $("#product-table #price #discount_price").each(function() {
                var value = $(this).text()
                discountPrices.push(value.replace(',', ''))
            })

            $("#product-table #quantity #input_quantity").each(function() {
                var value = $(this).val()
                if (!value) {
                    quantities.push("0")
                } else {
                    quantities.push(value.replace(',', ''))
                }
            })

            var totalPrice = 0
            var totalDiscount = 0
            for (let i = 0; i < prices.length; i++) {
                var price = parseFloat(prices[i])
                var quantity = parseFloat(quantities[i])
                var discountPrice = parseFloat(discountPrices[i])

                var productPrice = price * quantity
                totalPrice += productPrice

                var discount = (price - discountPrice) * quantity
                totalDiscount += discount
            }
            var finalPrice = totalPrice - totalDiscount

            $("#total_price").text(totalPrice.toLocaleString())
            $("#total_discount").text(totalDiscount.toLocaleString())
            $("#final_price").text(finalPrice.toLocaleString())
        }

        $(document).ready(function(){
            calculateDiscount()
            calculatePrice()
        })

        $(document).on('input', '#quantity', function() {
            calculateDiscount()
            calculatePrice()
        })

        $(document).on('change', '#unit', function() {
            calculateDiscount()
            calculatePrice()
        })
    </script>
    <script>
        $("#order_submit").click(function(e) {
            e.preventDefault();
            $("#order_submit").prop("disabled", true);
            $("#order_submit").html("<span class='spinner-border spinner-border-sm'></span> Loading...");

            var productSlug = [];
            var productQuantity = [];
            var units = [];

            $("#product-table #quantity #input_quantity").each(function() {
                var value = $(this).val();
                productQuantity.push(value.replace(',', ''));
            });

            $("#product-table #quantity #product_slug").each(function() {
                var value = $(this).val();
                productSlug.push(value.replace(',', ''));
            });

            $("#product-table #price #unit").each(function() {
                var value = $(this).val();
                unit = value.split(';')[0];
                units.push(unit);
            });

            $.ajax({
                type: "post",
                url: "{{ url('customer/order') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "product_slug": productSlug,
                    "product_quantity": productQuantity,
                    "unit": units,
                },
                success: function(result) {
                    // console.log('success', result);
                    window.location.href = "{{ url('customer/order') }}";
                },
                error: function(result) {
                    // console.log('error', result);
                    if (result.responseJSON.redirect) {
                        $("#errorModal .modal-dialog .modal-content #title").html("ต้องการข้อมูลเพิ่มเติม...");
                        $("#errorModal .modal-dialog .modal-content .modal-footer #closeButton").text("กรอกที่อยู่")
                        $("#errorModal .modal-dialog .modal-content .modal-footer #closeButton").click(function(){
                            window.location.href = result.responseJSON.redirect;
                        });
                    } else {
                        $("#errorModal .modal-dialog .modal-content #title").html("เกิดข้อผิดพลาด...");
                    }
                    $("#errorModal .modal-dialog .modal-content #message").html(result.responseJSON.errors);
                    $('#errorModal').modal('show');

                    $("#order_submit").prop("disabled", false);
                    $("#order_submit").html("ยืนยันการสั่งซื้อ");
                }
            });
        });
    </script>
@endsection
