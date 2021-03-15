@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มสินค้า</h4>
            <span>เจ้าหน้าที่สามารถเพิ่มสินค้า</span>
        </div>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/products', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.product._form')
        <button type="submit" class="btn btn-primary btn-block">เพิ่มสินค้า</button>
    {!! Form::close() !!}
</div>
@endsection
