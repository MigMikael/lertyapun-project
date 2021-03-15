@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มผู้ใช้งาน</h4>
            <span>เจ้าหน้าที่สามารถเพิ่มผู้ใช้งาน</span>
        </div>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/customers', 'method' => 'post', 'files' => 'true']) !!}
    @include('admin.customer._form')
    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">เพิ่มผู้ใช้งาน</button>
    {!! Form::close() !!}
    @endsection
</div>