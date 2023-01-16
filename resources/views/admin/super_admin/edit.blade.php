@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">แก้ไขผู้ดูแล</h4>
            <span>ผู้ดูแลสามารถแก้ไขบัญชีผู้ดูแลเพิ่มได้</span>
        </div>
    </div>
    <hr>
    {!! Form::model($super_admin, ['url' => 'admin/super_admins/'.$super_admin->slug, 'method' => 'put', 'files' => 'true']) !!}
    @include('admin.super_admin._form')
    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขข้อมูลผู้ดูแล</button>
    {!! Form::close() !!}
</div>
@endsection
