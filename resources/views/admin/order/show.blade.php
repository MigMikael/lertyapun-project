@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">
                รหัสคำสั่งซื้อ
                {{ $order->slug }}
                @if($order->status == 'pending')
                (<span class="badge badge-light">รอการอนุมัติ</span>)
                @elseif($order->status == 'payment' && $order->slip_image_id == null)
                (<span class="badge badge-secondary">รอการชำระเงิน</span>)
                @elseif($order->status == 'payment' && $order->slip_image_id != null)
                (<span class="badge badge-warning">รอยืนยันการชำระเงิน</span>)
                @elseif($order->status == 'success')
                (<span class="badge badge-success">สำเร็จ</span>)
                @elseif($order->status == 'cancle')
                (<span class="badge badge-danger">ยกเลิก</span>)
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
                    <th scope="col">หน่วย</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ url('image/thumbnail/'.$product->image->slug) }}" style="height: 30px; width: 30px" class="img-fluid" alt="{{ $product->name }}">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->pivot->order_price) }}</td>
                        <td>{{ number_format($product->pivot->sale_quantity) }}</td>
                        <td>{{ $product->pivot->sale_unit }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    <hr>
    <div class="row">
        <div class="col-md-12">
            @if($order->slip_image_id != null)
                <img class="img-md" src="{{ url('image/thumbnail/'.$order->slipImage->slug) }}">
            @endif
        </div>
    </div>
</div>
@endsection
