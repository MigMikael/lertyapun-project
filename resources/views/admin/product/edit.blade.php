@extends('template.admin')

@section('content')
<div class="admin-container">
<div class="row">
    <div class="col-md-12">
        <h4 class="title">แก้ไขสินค้า</h4>
        <span>เจ้าหน้าที่สามารถแก้ไขสินค้า</span>
    </div>
</div>
    <hr>
    {!! Form::model($product, ['url' => 'admin/products/'.$product->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.product._form_edit')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขสินค้า</button>
    {!! Form::close() !!}
</div>
@endsection
