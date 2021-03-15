@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">แก้ไขข้อมูลผู้ใช้งาน</h4>
            <span>เจ้าหน้าที่สามารถแก้ไขข้อมูลผู้ใช้งาน</span>
        </div>
    </div>
    <hr>
    {!! Form::model($customer, ['url' => 'admin/customers/'.$customer->slug, 'method' => 'put', 'files' => 'true']) !!}
    @include('admin.customer._form')
    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขข้อมูลผู้ใช้งาน</button>
    {!! Form::close() !!}
</div>
@endsection