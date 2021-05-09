@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">แก้ไขข้อมูลบริการขนส่ง</h4>
            <span>เจ้าหน้าที่สามารถแก้ไขข้อมูลบริการขนส่ง</span>
        </div>
    </div>
    <hr>
    {!! Form::model($delivery, ['url' => 'admin/deliveries/'.$delivery->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.dalivery._form')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขข้อมูลบริการขนส่ง</button>
    {!! Form::close() !!}
</div>
@endsection
