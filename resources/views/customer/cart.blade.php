@extends('template.customer')

@section('head')

@endsection

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
                                <div class="form-group">
                                    <h5 class="title">รายการสินค้า</h5>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if (count($customer->cart) === 0)
                                <div class="text-center">
                                    <img class="no-item-cart-img" src="{{ url('img/no-item-cart.png') }}">
                                    <h5 style="padding-top: 15px; padding-bottom: 15px;">เลือกสินค้าที่สนใจใส่รถเข็นได้เลย</h5>
                                    <a href="{{ url('/customer/products') }}" class="btn btn-primary">ช้อปตอนนี้</a>
                                </div>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-border table-shopping-cart">
                                        <thead>
                                            <tr>
                                                <th>
                                                    สินค้า
                                                </th>
                                                <th>
                                                    ราคา
                                                </th>
                                                <th>
                                                    จำนวน
                                                </th>
                                                <th class="text-center">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer->cart as $product)
                                            <tr id="product-table">
                                                <td id="name" style="padding-left: 0px;">
                                                    <figure class="itemside">
                                                        <div class="aside">
                                                            <img class="img-sm" src="{{ url('image/show/'.$product->image->slug) }}">
                                                        </div>
                                                        <figcaption class="info">
                                                            <a href="{{ url('customer/products/'.$product->slug) }}" class="title text-dark">
                                                                <strong>{{ $product->name }}</strong>
                                                                @if(count($product->promotions) > 0)
                                                                    @foreach ($product->promotions->reverse() as $promotion)
                                                                        <span class="badge badge-danger" style="font-weight: normal" id="promotion_name">ลด {{ $promotion->name }}%</span>
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
                                                <td id="price">
                                                    <select id="unit" name="unit" id="unit" class="form-control">
                                                        @foreach($product->units as $productUnit)
                                                        <option value="{{ $productUnit->unitName }};{{ $productUnit->pricePerUnit }};{{ $productUnit->quantityPerUnit }}" @if($productUnit->unitName == $product->pivot->unitName)selected="selected"@endif>
                                                            {{ $productUnit->unitName }}
                                                            @if(!$loop->first)
                                                            - {{ $productUnit->quantityPerUnit }} {{ $product->units['0']['unitName'] }}
                                                            @endif
                                                            - <strong>{{ $productUnit->pricePerUnit }} บาท</strong>
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <p id="discount_price_container" style="color: red;font-size: 14px; margin-top: 5px;">ลดราคาเหลือ <span id="discount_price">0</span> บาท</p>
                                                </td>
                                                <td id="quantity">
                                                    <input id="input_quantity"
                                                        type="number" class="form-control"
                                                        value="{{ $product->pivot->quantity }}"
                                                        min="1"
                                                        max="{{ $product->quantity }}"
                                                        >
                                                    <input id="product_slug" type="hidden" value="{{ $product->slug }}">
                                                    <p style="font-size: 14px; margin-top: 5px; color: #28a745;">เหลือ {{ number_format($product->quantity) }} {{ $product->units['0']['unitName'] }}</p>
                                                </td>
                                                <td id="action" class="text-center">
                                                    {!! Form::model($product, [
                                                        'method' => 'delete',
                                                        'url' => 'customer/cart/'.$product->slug ]) !!}
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <p style="font-size: 12px; color: white">x</p>
                                                    {!! Form::close() !!}
                                                    <p id="product_weight" style="display: none">{{ $product->weight }}</p>
                                                </td>
                                            </tr>
                                            @endforeach

                                            <tr id="shipment_method">
                                                <td style="padding-left: 0px;">
                                                    <p>เลือกบริการขนส่ง</p>
                                                </td>
                                                <td id="shipment_method_select">
                                                    <select id="deliveryService" name="deliveryService" id="deliveryService" class="form-control">
                                                        @foreach($deliveryServices as $deliveryService)
                                                        <option value="{{ $deliveryService->name }}">
                                                            {{ $deliveryService->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endif
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
                                <label>รวมการสั่งซื้อ</label>
                            </div>
                            <div class="col-md-6 text-right">
                                ฿<span id="total_price">฿{{ number_format($customer->totalPrice, 2) }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ส่วนลด</label>
                            </div>
                            <div class="col-md-6 text-right">
                                ฿<span id="total_discount">฿{{ number_format($customer->totalDiscount, 2) }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ค่าจัดส่งสินค้า</label>
                            </div>
                            <div class="col-md-6 text-right">
                                ฿<span id="shipment_price">{{ number_format(0, 2) }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>รวมสุทธิ</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5>฿<span id="final_price">{{ number_format($customer->finalPrice, 2) }}<span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="order_submit" disabled type="submit" class="btn btn-primary btn-block">ยืนยันการสั่งซื้อ</button>
                                <p id="remark"></p>
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

                $(this).text(discountPrice.toFixed(2).toString())
                count += 1
            })
        }

        function calculatePrice() {
            var prices = []
            var discountPrices = []
            var quantities = []
            var quantitiesPerUnits = []
            var weights = []

            $("#product-table #price #unit").each(function() {
                var value = $(this).val()
                price = value.split(';')[1]
                prices.push(price.replace(',', ''))
            })

            $("#product-table #price #unit").each(function() {
                var value = $(this).val()
                quantitiesPerUnit = value.split(';')[2]
                quantitiesPerUnits.push(quantitiesPerUnit.replace(',', ''))
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

            $("#product-table #action #product_weight").each(function() {
                var value = $(this).text()
                weights.push(value)
            })

            var totalPrice = 0
            var totalDiscount = 0
            var totalWeight = 0
            for (let i = 0; i < prices.length; i++) {
                var price = parseFloat(prices[i])
                var quantity = parseFloat(quantities[i])
                var discountPrice = parseFloat(discountPrices[i])
                var quantitiesPerUnit = parseFloat(quantitiesPerUnits[i])
                var weight = parseFloat(weights[i])

                var productPrice = price * quantity
                totalPrice += productPrice

                var discount = (price - discountPrice) * quantity
                totalDiscount += discount

                var productWeight = quantitiesPerUnit * weight * quantity
                totalWeight += productWeight
            }
            var totalWeightKg = Math.floor(totalWeight / 1000)
            var shipmentRate = [ 15, 25, 35, 45, 55, 60, 77, 89, 101, 113, 125, 137, 149, 161, 173, 185, 205, 225, 245, 265, 270, 270, 280, 290, 300, 310, 320, 330, 340, 350, 360, 370, 380, 390, 400, 410, 420, 430, 440, 450, 460, 470, 480, 490, 500, 510, 520, 530, 540, 550, 560, 575, 590, 605, 620, 635, 650, 665, 680, 695, 710, 725, 740, 755, 770, 785, 800, 815, 830, 845, 860, 875, 890, 905, 920, 935, 950, 965, 980, 995, 1010, 1025, 1040, 1055, 1070, 1085, 1100, 1115, 1130, 1145, 1160, 1175, 1190, 1205, 1220, 1235, 1250, 1265, 1280, 1295, 1310 ]

            var shipmentPrice = 0
            if (totalWeightKg < 0) {
                shipmentPrice = 0
            } else if (totalWeightKg >= 0 && totalWeightKg <= 100) {
                shipmentPrice = shipmentRate[totalWeightKg]
            } else {
                shipmentPrice = shipmentRate.slice(-1)[0]
            }

            var finalPrice = (totalPrice - totalDiscount) + shipmentPrice
            if(finalPrice < 5000){
                $("#order_submit").prop('disabled', true)
                $("#remark").text("*ยอดสั่งสินค้าขั้นต่ำ 5,000 บาท")
            } else {
                $("#order_submit").prop('disabled', false)
                $("#remark").text("")
            }

            $("#total_price").text(totalPrice.toLocaleString())
            $("#total_discount").text(totalDiscount.toLocaleString())
            $("#shipment_price").text(shipmentPrice.toLocaleString())
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
                units.push(unit)
            });

            var shipmentMethod = $('#shipment_method #shipment_method_select #deliveryService').val();

            // console.log("shipmentMethod", shipmentMethod)
            // console.log("product_slug", productSlug)
            // console.log("product_quantity", productQuantity)
            // console.log("unit", units)

            $.ajax({
                type: "post",
                url: "{{ url('customer/order') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "product_slug": productSlug,
                    "product_quantity": productQuantity,
                    "unit": units,
                    "shipment_method": shipmentMethod,
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
