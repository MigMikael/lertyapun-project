@extends('template.admin')

@section('head')
<link href="{{ URL::asset('css/lightgallery.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>

<link href="{{ URL::asset('css/print.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/print.min.js') }}"></script>
<style>
    .table-bordered thead td, .table-bordered thead th {
        border-bottom-width: 1px !important;
    }

    .table thead th {
        border: 1px solid #000 !important;
    }

    .table tbody tr {
        border: 1px solid #00000050 !important;
    }

    .table-bordered td, .table-bordered th {
        border: none !important;
    }
</style>
<!-- CDN/Reference To the pluggin PrintThis.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"
integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w=="
crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-6">
            <h5 class="title">เลขที่คำสั่งซื้อ: {{ $order->slug }}</h5>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <button class="btn btn-primary" onclick="printDiv('printOrderForm')">
                    <i class="fas fa-print"></i> Print Order
                </button>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div id="printOrderForm">
        <div class="row">
            <div class="col-md-4">
                <strong>เลิศยาภัณฑ์</strong><br>
                <span>
                    384-386 ถ.แสงชูโต ต.ท่าเรือ อ.ท่ามะกา จ.กาญจนบุรี 71130
                </span><br>
                <span>
                    โทร: 034-561128
                </span>
            </div>
            <div class="col-md-4">
               <div style="widh: 100%; height: 40px; border: 2px solid #000; position: relative;">
                <div class="center">
                    <strong>ใบรายการคำสั่งซื้อ</strong>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                    <span style="float: right;">
                        <strong>เลขที่คำสั่งซื้อ:</strong> {{ $order->slug }}
                    </span>
                    <span style="float: right;">
                        <strong>วันที่คำสั่งซื้อ:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/y') }} {{ \Carbon\Carbon::parse($order->order_date)->format('H:i:s') }}
                    </span>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <span><strong>ชื่อลูกค้า:</strong> {{ $order->customer->first_name }} {{ $order->customer->last_name }}</span><br>
                    <span><strong>โทร:</strong> {{ $order->customer->phone }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span style="float: right;">
                        <strong>ที่อยู่:</strong> {{ $order->customer->addresses[0]->detail }} ต.{{ $order->customer->addresses[0]->subDistrict }}
                        อ.{{ $order->customer->addresses[0]->district }} จ.{{ $order->customer->addresses[0]->province }} {{ $order->customer->addresses[0]->zipcode }}
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">รหัสสินค้า</th>
                                <th class="text-center">รายการ</th>
                                <th class="text-center">จำนวน/หน่วย</th>
                                <th class="text-right">ราคา/หน่วย</th>
                                <th class="text-right">รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                            <!--onclick="window.location='{{ url('admin/products/'.$product->slug) }}'"-->
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <th class="text-center">{{ $product->slug }}</th>
                                    <td><a href="{{ url('admin/products/'.$product->slug) }}" style="text-decoration: none; color: #000;">{{ $product->name }}</a></td>
                                    <td class="text-center">
                                        {{ number_format($product->pivot->sale_quantity) }} {{ $product->pivot->sale_unit }} <!--({{ $product->pivot->quantityPerUnit * $product->pivot->sale_quantity }} ชิ้น)-->
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($product->pivot->order_price / $product->pivot->sale_quantity, 2) }}
                                    </td>
                                    <td class="text-right">{{ number_format($product->pivot->order_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right">
                                    รวมการสั่งซื้อ
                                </td>
                                <td class="text-right">
                                    {{ number_format($order->total_amount - $order->shipment_price, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right">
                                    ค่าจัดส่งสินค้า
                                </td>
                                <td class="text-right">
                                    {{ number_format($order->shipment_price, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <strong>น้ำหนักโดยประมาณ</strong>
            </div>
            <h6>{{ number_format($order->weight, 2) }} กรัม</h6>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <strong>ยอดรวมการสั่งซื้อ</strong>
            </div>
            <h6>{{ number_format($order->total_amount - $order->shipment_price, 2) }} บาท</h6>
        </div>
        {{-- @if($order->shipment_price != 0)
        <div class="col-md-3">
            <div class="form-group">
                <strong>ค่าจัดส่งสินค้า</strong>
            </div>
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/shipment_price/free', 'method' => 'put', 'class' => 'form-inline']) !!}
            <h6>{{ number_format($order->shipment_price, 2) }} บาท</h6><button type="submit" class="btn btn-outline-primary btn-sm" style="margin-left: 25px;">ฟรีค่าจัดส่ง</button>
            {!! Form::close() !!}
        </div>
        @else
        <div class="col-md-3">
            <div class="form-group">
                <strong>ค่าจัดส่งสินค้า</strong>
            </div>
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/shipment_price/price', 'method' => 'put', 'class' => 'form-inline']) !!}
            <h6>{{ number_format($order->shipment_price, 2) }} บาท</h6><button type="submit" class="btn btn-outline-primary btn-sm" style="margin-left: 25px;">คิดค่าจัดส่ง</button>
            {!! Form::close() !!}
        </div>
        @endif --}}
        <div class="col-md-3">
            <div class="form-group">
                <strong>ค่าจัดส่งสินค้า</strong>
            </div>
            <h6>{{ number_format($order->shipment_price, 2) }} บาท</h6>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <strong>ยอดรวมสุทธิ</strong>
            </div>
            <h6>{{ number_format($order->total_amount, 2) }} บาท</h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <strong>ที่อยู่จัดส่ง</strong>
            </div>
            <p>{{ $order->customer->addresses[0]->detail }} ตำบล{{ $order->customer->addresses[0]->subDistrict }}</p>
            <p>อำเภอ{{ $order->customer->addresses[0]->district }} จังหวัด{{ $order->customer->addresses[0]->province }}</p>
            <p>รหัสไปรษณีย์ {{ $order->customer->addresses[0]->zipcode }}</p>
            <p>เบอร์โทรศัพท์ {{ $order->customer->phone }}</p>
            <p>Email {{ $order->customer->email }}</p>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <strong>จัดส่งโดย</strong>
            </div>
            <p>{{ $order->shipment_method }}</p>
        </div>
    </div>
    <hr>
    @if($order->slip_image_id != null)
    <div id="slip-view" class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong class="form-group">สลิปการชำระเงิน</strong>
            </div>
            <a href="{{ url('image/show/'.$order->slipImage->slug) }}" >
                <img src="{{ url('image/show/'.$order->slipImage->slug) }}" style="width: 250px;" class="img-fluid" >
            </a>
        </div>
    </div>
    <hr>
    @endif
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/status', 'method' => 'put']) !!}
            <div class="form-group" style="margin-bottom: 3%">
                <div class="form-group">
                    <strong>สถานะคำสั่งซื้อ</strong>
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
                </div>
                {!! Form::select('status', $status, $order->status, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group" style="margin-bottom: 3%">
                <strong>{!! Form::label('shipment_price', 'ค่าขนส่ง (บาท)') !!}</strong>
                {!! Form::text('shipment_price', $order->shipment_price, ['placeholder' => 'ค่าขนส่ง', 'class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">ยืนยัน</button>
            {!! Form::close() !!}
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-outline-primary" onclick="printJS({
                printable: 'printable',
                type: 'html',
                header: '<hr><h2>ยอดสั่งซื้อรวม {{ number_format($order->total_amount) }} บาท</h2>' + '<h2>นำหนักโดยประมาณ {{ number_format($order->weight) }} กรัม</h2>' + '<h2>ค่าจัดส่งสินค้า {{ number_format($order->shipment_price) }} บาท</h2><hr>',
            })">
                ปริ้นคำสั่งซื้อ
            </button>
        </div>
    </div>
    -->
</div>
@endsection

@section('script')
    <script >
        function printDiv(divName) {
             var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
        }
    </script>
@endsection
