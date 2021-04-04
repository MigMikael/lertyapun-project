@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="title">
                        รายระเอียดการสั่งซื้อหมายเลข {{ $order->slug }}
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
                    <span>นำหนักสินค้าโดยประมาณ {{ number_format($order->weight) }} กรัม</span>
                </div>

                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-shopping-cart">
                            <thead>
                                <tr>
                                    <th>
                                        สินค้า
                                    </th>
                                    <th width="160" class="text-right">
                                        ราคา (บาท)
                                    </th>
                                    <th width="110" class="text-right">
                                        จำนวน
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr id="product-table">
                                    <td class="align-middle">
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
                                    <td id="price" class="text-right">
                                        <span id="base_price">{{ number_format($product->pivot->order_price) }}</span>
                                    </td>
                                    <td id="quantity" class="text-right">
                                        <span id="base_price">{{ number_format($product->pivot->sale_quantity) }}</span>
                                        {{ $product->pivot->sale_unit }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h5>แนบหลักฐานการชำระเงิน</h5>
                    @if($order->status == 'pending')
                    <p>(กรุณารออนุมัติคำสั่งซื้อ ก่อนแนบหลักฐานการโอนเงิน)</p>
                    @endif
                </div>
                <div class="col-md-6">
                    {!! Form::open(['url' => 'customer/order/'. $order->slug .'/slip', 'method' => 'put', 'files' => 'true']) !!}
                        <div class="form-group">
                            {!! Form::file('slip_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a slip image']) !!}
                        </div>
                        <button type="submit" class="btn btn-primary" @if($order->status == 'pending')disabled @endif>แนบสลิป</button>
                    {!! Form::close() !!}
                </div>
                <div id="aniimated-thumbnials" class="col-md-6">
                    @if($order->slip_image_id != null)
                    <a class="col-md-2" href="{{ url('image/show/'.$order->slipImage->slug) }}">
                        <img src="{{ url('image/thumb/'.$order->slipImage->slug) }}" style="width: 100%" class="img-fluid" alt="Slip from order id {{ $order->slug }}">
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
@endsection
