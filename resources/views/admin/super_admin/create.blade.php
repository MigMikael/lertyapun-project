@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มผู้ดูแล</h4>
            <span>ผู้ดูแลสามารถสร้างบัญชีผู้ดูแลเพิ่มได้</span>
        </div>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/super_admins', 'method' => 'post', 'files' => 'true']) !!}
    @include('admin.super_admin._form')
    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">เพิ่มผู้ดูแล</button>
    {!! Form::close() !!}
    @endsection
</div>
