@extends('template.admin')

@section('head')
<link href="{{ URL::asset('css/lightgallery.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>

<link href="{{ URL::asset('css/print.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/print.min.js') }}"></script>
@endsection

@section('content')
<div class="admin-container">
    <div id="printable">
        <div class="row">
            <div class="col-md-12">
                <h4 class="title">
                    รหัสคำสั่งซื้อ
                    {{ $order->slug }}
                    @if($order->status == 'pending')
                    <span class="badge badge-secondary">รอการอนุมัติ</span>
                    @elseif($order->status == 'payment' && $order->slip_image_id == null)
                    <span class="badge badge-warning">รอการชำระเงิน</span>
                    @elseif($order->status == 'payment' && $order->slip_image_id != null)
                    <span class="badge badge-warning">รอยืนยันการชำระเงิน</span>
                    @elseif($order->status == 'success')
                    <span class="badge badge-success">สำเร็จ</span>
                    @elseif($order->status == 'cancle')
                    <span class="badge badge-danger">ยกเลิก</span>
                    @endif
                </h4>
                <span>ชื่อลูกค้า {{ $order->customer->first_name }} {{ $order->customer->last_name }}</span>
                <hr>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รูปสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">ราคา (บาท)</th>
                        <th scope="col">จำนวน</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr onclick="window.location='{{ url('admin/products/'.$product->slug) }}'">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ url('image/show/'.$product->image->slug) }}" style="height: 100px; width: 100px" class="img-fluid" alt="{{ $product->name }}">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->pivot->order_price) }}</td>
                            <td>
                                {{ number_format($product->pivot->sale_quantity) }} {{ $product->pivot->sale_unit }} ({{ $product->pivot->quantityPerUnit * $product->pivot->sale_quantity }} ชิ้น)
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>นำหนักโดยประมาณ {{ number_format($order->weight) }} กรัม</h6>
        </div>
        <div class="col-md-4">
            <h6>ยอดสั่งซื้อรวม {{ number_format($order->total_amount) }} บาท</h6>
        </div>
        @if($order->shipment_price != 0)
        <div class="col-md-4">
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/shipment_price/free', 'method' => 'put', 'class' => 'form-inline']) !!}
            <h6>ค่าจัดส่งสินค้า {{ number_format($order->shipment_price) }} บาท</h6>
            <button type="submit" class="btn btn-outline-primary btn-sm" style="margin-left: 5px;">ฟรีค่าจัดส่ง</button>
            {!! Form::close() !!}
        </div>
        @else
        <div class="col-md-4">
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/shipment_price/price', 'method' => 'put', 'class' => 'form-inline']) !!}
            <h6>ค่าจัดส่งสินค้า {{ number_format($order->shipment_price) }} บาท</h6>
            <button type="submit" class="btn btn-outline-primary btn-sm" style="margin-left: 5px;">คิดค่าจัดส่ง</button>
            {!! Form::close() !!}
        </div>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/orders/'. $order->slug .'/status', 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('สถานะคำสั่งซื้อ') !!}
                {!! Form::select('status', $status, $order->status, ['class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">ยืนยัน</button>
            {!! Form::close() !!}
        </div>
    </div>
    @if($order->slip_image_id != null)
    <hr>
    <div id="aniimated-thumbnials" class="row">
        <a class="col-md-2" href="{{ url('image/show/'.$order->slipImage->slug) }}">
            <img src="{{ url('image/show/'.$order->slipImage->slug) }}" style="width: 100%" class="img-fluid" alt="Slip from order id {{ $order->slug }}">
        </a>
    </div>
    @endif
    <hr>
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
</div>
@endsection

@section('script')
    <script>
        $('#aniimated-thumbnials').lightGallery({
            thumbnail:true
        });
    </script>
@endsection
