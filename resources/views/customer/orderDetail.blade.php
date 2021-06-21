@extends('template.customer')

@section('content')
<style>
    #content {
        margin-bottom: 0px !important;
    }
</style>
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div class="row form-group">
            <div class="col-md-12">
                <h5 class="title">
                    เลขที่คำสั่งซื้อ: {{ $order->slug }}
                </h5>
                <div class="form-group">
                    <span>สถานะคำสั่งซื้อ: <strong>
                        @if($order->status == 'pending')
                        <span class="badge badge-warning">รอการอนุมัติ</span>
                        @elseif($order->status == 'payment' && $order->slip_image_id == null)
                        <span class="badge badge-warning-secondary">รอการชำระเงิน</span>
                        @elseif($order->status == 'payment' && $order->slip_image_id != null)
                        <span class="badge badge-warning-secondary">รอยืนยันการชำระเงิน</span>
                        @elseif($order->status == 'credit')
                        <span class="badge badge-primary">เครดิต</span>
                        @elseif($order->status == 'success')
                        <span class="badge badge-success">สำเร็จ</span>
                        @elseif($order->status == 'cancle')
                        <span class="badge badge-danger">ยกเลิก</span>
                    @endif
                    </strong>
                    </span>
                </div>
                <!--<span>น้ำหนักสินค้าโดยประมาณ {{ number_format($order->weight) }} กรัม</span>-->
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <h5 class="title">รายการสินค้า</h5>
                        </div>
                        <div class="form-group table-responsive">
                            <table class="table table-border table-shopping-cart">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>สินค้า</th>
                                        <th class="text-right">จำนวน/หน่วย</th>
                                        <th class="text-right">ราคา/หน่วย</th>
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
                                                    <a href="{{ url('customer/products/'.$product->slug) }}"
                                                        class="title text-dark">
                                                        <p>{{ $product->name }}</p>
                                                    </a>
                                                </figcaption>
                                            </figure>
                                        </td>
                                        <td id="quantity" class="text-right">
                                            <span id="base_price">{{ number_format($product->pivot->sale_quantity) }}</span>
                                            {{ $product->pivot->sale_unit }}
                                        </td>
                                        <td id="price" class="text-right">
                                            {{ number_format($product->pivot->order_price / $product->pivot->sale_quantity, 2) }}
                                            บาท
                                        </td>
                                        <td class="text-right">{{ number_format($product->pivot->order_price, 2) }} บาท</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-right">
                                            <strong>ราคารวม</strong>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($order->total_amount - $order->shipment_price, 2) }} บาท
                                        </td>
                                    </tr>
                                    @if ($order->status != 'pending')
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-right">
                                            <strong>ค่าจัดส่งสินค้า</strong>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($order->shipment_price, 2) }} บาท
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-right">
                                            <strong>รวมสุทธิ</strong>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($order->total_amount, 2) }} บาท
                                        </td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>ที่อยู่จัดส่ง</h5>
                                </div>
                                <label>{{ $order->customer->addresses[0]->detail }} ตำบล{{ $order->customer->addresses[0]->subDistrict }}</label><br>
                                <label>อำเภอ{{ $order->customer->addresses[0]->district }} จังหวัด{{ $order->customer->addresses[0]->province }}</label><br>
                                <label>รหัสไปรษณีย์ {{ $order->customer->addresses[0]->zipcode }}</label><br>
                                <label>เบอร์โทรศัพท์ {{ $order->customer->phone }}</label><br>
                                <label>อีเมล {{ $order->customer->email }}</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>จัดส่งสินค้าโดย</h5>
                                </div>
                                <label>{{ $order->shipment_method }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($order->status != 'pending')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>บัญชีธนาคาร</h5>
                                </div>
                                @foreach ($banks as $bank)
                                <div class="card form-group">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                              <td style="padding-right:20px">
                                                <!--<img src=" url('image/show/'.$bank->image->slug) " style="width: 50px;">-->
                                                @if ($bank->bank_name == "scb")
                                                <img src="{{ URL::asset('img/bank/scb.jpg') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "kbank")
                                                <img src="{{ URL::asset('img/bank/kbank.jpg') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "bbl")
                                                <img src="{{ URL::asset('img/bank/bbl.png') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "tmb")
                                                <img src="{{ URL::asset('img/bank/tmb.jpg') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "ktb")
                                                <img src="{{ URL::asset('img/bank/ktb.jpg') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "gsb")
                                                <img src="{{ URL::asset('img/bank/gsb.jpg') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "bay")
                                                <img src="{{ URL::asset('img/bank/bay.jpg') }}" style="width: 50px;">
                                                @elseif ($bank->bank_name == "tbank")
                                                <img src="{{ URL::asset('img/bank/tbank.jpg') }}" style="width: 50px;">
                                                @else
                                                <img src="{{ URL::asset('img/bank/other-bank.jpg') }}" style="width: 50px;">
                                                @endif
                                              </td>
                                              <td>                                            
                                                <label style="font-weight: 700;">ธนาคาร{{ config('constants.bankNames')[$bank->bank_name] }}</label><br>
                                                <label>เลขบัญชี {{ $bank->account_no }}</label><br>
                                                <label>ชื่อบัญชี {{ $bank->account_name }}</label><br>
                                                <label>สาขา {{ $bank->branch_name }}</label>
                                            </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>แนบหลักฐานการชำระเงิน</h5>
                                    <!--@if($order->status == 'pending')
                                    <p>(กรุณารอการอนุมัติคำสั่งซื้อ ก่อนแนบหลักฐานการโอนเงิน)</p>
                                    @endif-->
                                </div>
                                {!! Form::open(['url' => 'customer/order/'. $order->slug .'/slip', 'method' => 'put', 'files' => 'true']) !!}
                                @if ($order->status == 'payment')
                                <div class="form-group">
                                    <label class="btn btn-primary">
                                        <i class="fa fa-image"></i>
                                        @if($order->slip_image_id != null)
                                        แก้ไขรูปสลิป
                                        @else
                                        อัพโหลดสลิป
                                        @endif
                                        {!! Form::file('slip_image', ['accept'=>'image/*', 'id' => 'upload-slip-img', 'class' =>
                                        'form-control hidden', 'value' => 'Choose
                                        a slip image']) !!}
                                    </label>
                                </div>
                                @endif
                                <div id="slip-view">
                                    <div class="form-group">
                                        @if($order->slip_image_id != null)
                                        <a href="{{ url('image/show/'.$order->slipImage->slug) }}">
                                            <img id="slip-img" src="{{ url('image/show/'.$order->slipImage->slug) }}"
                                                alt="Slip from order id {{ $order->slug }}" style="width: 250px;">
                                        </a>
                                        @else
                                        <img id="slip-img" src="{{ URL::asset('img/placeholder-image.jpg') }}" style="width: 250px;">
                                        @endif
                                    </div>
                                </div>
                                @if($order->status == 'payment')
                                    <button type="submit" class="btn btn-primary">ยืนยันสลิปการโอน</button>
                                @endif
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--
        @if ($order->status == 'payment')
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
            {!! Form::open(['url' => 'customer/order/'. $order->slug .'/slip', 'method' => 'put', 'files' => 'true'])
            !!}
            <div class="col-md-12">
                <div class="form-group">
                    <label class="btn btn-primary">
                        <i class="fa fa-image"></i>
                        @if($order->slip_image_id != null)
                        แก้ไขรูปสลิป
                        @else
                        อัพโหลดสลิป
                        @endif
                        {!! Form::file('slip_image', ['accept'=>'image/*', 'id' => 'upload-slip-img', 'class' =>
                        'form-control hidden', 'value' => 'Choose
                        a slip image']) !!}
                    </label>
                </div>
            </div>
            <div id="slip-view" class="col-md-4">
                <div class="form-group">
                    @if($order->slip_image_id != null)
                    <a href="{{ url('image/show/'.$order->slipImage->slug) }}">
                        <img id="slip-img" src="{{ url('image/show/'.$order->slipImage->slug) }}"
                            alt="Slip from order id {{ $order->slug }}" style="width: 250px;">
                    </a>
                    @else
                    <img id="slip-img" src="{{ URL::asset('img/placeholder-image.jpg') }}" style="width: 250px;">
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" @if($order->status == 'pending')
                    disabled
                    @endif>
                    ยืนยันสลิปการโอน</button>
            </div>
            {!! Form::close() !!}
        </div>
        @endif
    -->
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