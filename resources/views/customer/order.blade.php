@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="title">การซื้อของฉัน</h5>
                    <span>ประวัติการสั่งซื้อสินค้าทั้งหมดของฉัน</span>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="input-group mr-auto" style="margin-top: 10px; margin-bottom: 25px;">
                        <input type="text" class="form-control"
                            placeholder="ค้นหาตามหมายเลขคำสั่งซื้อ">
                        <div class="input-group-append">
                            <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#all" role="tab"
                                aria-controls="pills-home" aria-selected="true">ทั้งหมด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-waiting-confirm-tab" data-toggle="pill" href="#waiting-confirm" role="tab"
                                aria-controls="pills-waiting-confirm" aria-selected="false">รอการอนุมัติ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-waiting-payment-tab" data-toggle="pill" href="#waiting-payment" role="tab"
                                aria-controls="pills-waiting-payment" aria-selected="false">รอการชำระเงิน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-success-tab" data-toggle="pill" href="#success" role="tab"
                                aria-controls="pills-success" aria-selected="false">สำเร็จ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-cancel-tab" data-toggle="pill" href="#cancel" role="tab"
                                aria-controls="pills-cancel" aria-selected="false">ยกเลิก</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            @foreach ($orders as $order)
                                @include('customer._orderCard')
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="waiting-confirm" role="tabpanel" aria-labelledby="waiting-confirm-tab">
                            @foreach ($orders as $order)
                                @if ($order->status == 'pending')
                                    @include('customer._orderCard')
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="waiting-payment" role="tabpanel" aria-labelledby="waiting-payment-tab">
                            @foreach ($orders as $order)
                                @if ($order->status == 'payment')
                                    @include('customer._orderCard')
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="success" role="tabpanel" aria-labelledby="success-tab">
                            @foreach ($orders as $order)
                                @if ($order->status == 'success')
                                    @include('customer._orderCard')
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                            @foreach ($orders as $order)
                                @if ($order->status == 'cancle')
                                    @include('customer._orderCard')
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
@endsection
