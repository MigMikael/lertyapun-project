@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="title">
                        เลขที่คำสั่งซื้อ: {{ $order->slug }}
                        @if($order->status == 'pending')
                            <span class="badge badge-warning">รอการอนุมัติ</span>
                            @elseif($order->status == 'payment' && $order->slip_image_id == null)
                            <span class="badge badge-warning-secondary">รอการชำระเงิน</span>
                            @elseif($order->status == 'payment' && $order->slip_image_id != null)
                            <span class="badge badge-warning-secondary">รอยืนยันการชำระเงิน</span>
                            @elseif($order->status == 'success')
                            <span class="badge badge-success">สำเร็จ</span>
                            @elseif($order->status == 'cancle')
                            <span class="badge badge-danger">ยกเลิก</span>
                            @endif
                    </h4>
                    <!--<span>น้ำหนักสินค้าโดยประมาณ {{ number_format($order->weight) }} กรัม</span>-->
                </div>

                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="form-group table-responsive">
                        <table class="table table-border table-shopping-cart">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">รายการ</th>
                                    <th class="text-center">จำนวน</th>
                                    <th class="text-right">ราคา</th>
                                    <th class="text-right">รวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr id="product-table">
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">
                                        <figure class="itemside">
                                            <div class="aside">
                                                <img class="img-sm" src="{{ url('image/thumb/'.$product->image->slug) }}">
                                            </div>
                                            <figcaption class="info">
                                                <a href="{{ url('customer/products/'.$product->slug) }}" class="title text-dark">
                                                    <p>{{ $product->name }}</p>
                                                </a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td id="quantity" class="text-center">
                                        <span id="base_price">{{ number_format($product->pivot->sale_quantity) }}</span>
                                        {{ $product->pivot->sale_unit }}
                                    </td>
                                    <td id="price" class="text-right">
                                        {{ number_format($product->pivot->order_price / $product->pivot->sale_quantity, 2) }}
                                    </td>
                                    <td class="text-right">{{ number_format($product->pivot->order_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">
                                        รวมการสั่งซื้อ
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($order->total_amount - $order->shipment_price, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">
                                        ค่าจัดส่งสินค้า
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($order->shipment_price, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">
                                        รวมสุทธิ
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h5>จัดส่งสินค้าโดย</h5>
                        <p>{{ $order->shipment_method }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h5>แนบหลักฐานการชำระเงิน</h5>
                        @if($order->status == 'pending')
                        <p>(กรุณารอการอนุมัติคำสั่งซื้อ ก่อนแนบหลักฐานการโอนเงิน)</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                {!! Form::open(['url' => 'customer/order/'. $order->slug .'/slip', 'method' => 'put', 'files' => 'true']) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="btn btn-primary">
                            <i class="fa fa-image"></i>
                            @if($order->slip_image_id != null)
                            แก้ไขรูปสลิป
                            @else
                            อัพโหลดสลิป
                            @endif
                            {!! Form::file('slip_image', ['accept'=>'image/*', 'id' => 'upload-slip-img', 'class' => 'form-control hidden', 'value' => 'Choose
                            a slip image']) !!}
                        </label>
                    </div>
                </div>
                <div id="slip-view" class="col-md-4">
                    <div class="form-group">
                        @if($order->slip_image_id != null)
                        <a href="{{ url('image/show/'.$order->slipImage->slug) }}" >
                            <img id="slip-img" src="{{ url('image/show/'.$order->slipImage->slug) }}"
                                alt="Slip from order id {{ $order->slug }}" style="width: 250px;">
                        </a>
                        @else
                            <img id="slip-img" src="{{ URL::asset('img/placeholder-image.jpg') }}" style="width: 250px;">
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"
                    @if($order->status == 'pending')
                        disabled
                    @endif>
                    ยืนยันสลิปการโอน</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </nav>
</div>
@endsection

@section('script')
<script>
    function changeImgUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#slip-img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#upload-slip-img").change(function(){
        changeImgUrl(this);
    });
</script>
@endsection
