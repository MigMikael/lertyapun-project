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
                                    <table class="table table-borderless table-shopping-cart">
                                        <thead>
                                            <tr>
                                                <th>
                                                    สินค้า
                                                </th>
                                                <th width="150">
                                                    ราคา
                                                </th>
                                                <th width="120">
                                                    จำนวน
                                                </th>
                                                <th class="text-right">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer->cart as $product)
                                            <tr>
                                                <td>
                                                    <figure class="itemside">
                                                        <div class="aside">
                                                            <img class="img-sm" src="{{ url('image/thumbnail/'.$product->image->slug) }}">
                                                        </div>
                                                        <figcaption class="info">
                                                            <a href="{{ url('customer/products/'.$product->slug) }}" class="title text-dark">{{ $product->name }}</a>
                                                        </figcaption>
                                                    </figure>
                                                </td>
                                                <td>
                                                    ฿{{ number_format($product->price) }} {{ $product->unit }}
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" value="{{ $product->pivot->quantity }}" style="width: 80px;">
                                                </td>
                                                <td>
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
                                ฿{{ number_format($customer->totalPrice) }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ส่วนลด</label>
                            </div>
                            <div class="col-md-6 text-right">
                                ฿0
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>ยอดชำระเงินทั้งหมด</label>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5>฿{{ number_format($customer->totalPrice) }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block">ยืนยันการสั่งซื้อ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>
@endsection
