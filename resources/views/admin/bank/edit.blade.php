@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">แก้ไขข้อมูลบัญชีธนาคาร</h4>
            <span>เจ้าหน้าที่สามารถแก้ไขข้อมูลบัญชีธนาคาร</span>
        </div>
    </div>
    <hr>
    {!! Form::model($bank, ['url' => 'admin/banks/'.$bank->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.bank._form')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขข้อมูลบัญชีธนาคาร</button>
    {!! Form::close() !!}
</div>
@endsection
