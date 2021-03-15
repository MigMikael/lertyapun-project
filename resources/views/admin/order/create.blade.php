@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มคำสั่งซื้อ</h4>
            <span>เจ้าหน้าที่สามารถเพิ่มคำสั่งซื้อ</span>
        </div>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/orders', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.order._form')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">เพิ่มคำสั่งซื้อ</button>
    {!! Form::close() !!}
</div>
@endsection
