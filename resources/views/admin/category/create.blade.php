@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มประเภทสินค้า</h4>
            <span>เจ้าหน้าที่สามารถเพิ่มประเภทสินค้า</span>
        </div>
    </div>
    <hr>
        {!! Form::open(['url' => 'admin/categories', 'method' => 'post', 'files' => 'true']) !!}
            @include('admin.category._form')
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">เพิ่มประเภทสินค้า</button>
        {!! Form::close() !!}
    @endsection
</div>
