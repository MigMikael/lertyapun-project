@extends('template.admin')

@section('content')
<div class="admin-container">
    <h1 class="mt-4">LERTYAPHAN Store</h1>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h4>ลูกค้ารออนุมัติ</h4>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/customers') }}">
                        <h3>{{ $customerPending }} คน</h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h4>คำสั่งซื้อรออนุมัติ</h4>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/orders') }}">
                        <h3>{{ $orderPending }} คำสั่งซื้อ</h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h4>คำสั่งซื้อรอยืนยันเงินเข้า</h4>
                </div>
                <div class="card-body">
                    <a href="{{ url('admin/orders') }}">
                        <h3>{{ $orderPayment }} คำสั่งซื้อ</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
