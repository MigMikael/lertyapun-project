@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="title">การซื้อของฉัน ({{ $order->status }})</h5>
                    <span>รายระเอียดการสั่งซื้อ หมายเลข {{ Str::limit($order->slug, 10, "") }}</span>
                    <hr>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr id="product-table">
                                    <td class="align-middle">
                                        <figure class="itemside">
                                            <div class="aside">
                                                <img class="img-sm" src="{{ url('image/thumbnail/'.$product->image->slug) }}">
                                            </div>
                                            <figcaption class="info">
                                                <a href="{{ url('customer/products/'.$product->slug) }}" class="title text-dark">
                                                    <p>{{ $product->name }}</p>
                                                </a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td id="price" class="align-middle">
                                        <h6>฿<span id="base_price">{{ number_format($product->pivot->order_price) }}</span> ต่อ{{ $product->unit }}</h6>
                                    </td>
                                    <td id="quantity" class="align-middle">
                                        <h6>฿<span id="base_price">{{ number_format($product->pivot->sale_quantity) }}</span> {{ $product->unit }}</h6>
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
                <div class="col-md-6">
                    {!! Form::open(['url' => 'customer/order/'. $order->slug .'/slip', 'method' => 'put', 'files' => 'true']) !!}
                        <div class="form-group">
                            {!! Form::label('slip_image', 'Slip Image') !!} (ขั้นต่ำ 500 x 500px)
                            {!! Form::file('slip_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a slip image']) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">แนบสลิป</button>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6">
                    @if($order->slip_image_id != null)
                    <img class="img-md" src="{{ url('image/thumbnail/'.$order->slipImage->slug) }}">
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
@endsection
