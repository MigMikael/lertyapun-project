@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">แก้ไขข้อมูลประเภทสินค้า</h4>
            <span>เจ้าหน้าที่สามารถแก้ไขข้อมูลประเภทสินค้า</span>
        </div>
    </div>
    <hr>
    {!! Form::model($category, ['url' => 'admin/categories/'.$category->slug, 'method' => 'put', 'files' => 'true']) !!}
    @include('admin.category._form')
    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขข้อมูลประเภทสินค้า</button>
    {!! Form::close() !!}
</div>
@endsection