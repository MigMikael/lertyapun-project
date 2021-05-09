@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มบัญชีธนาคาร</h4>
            <span>เจ้าหน้าที่สามารถเพิ่มบัญชีธนาคาร</span>
        </div>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/banks', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.bank._form')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">เพิ่มบัญชีธนาคาร</button>
    {!! Form::close() !!}
</div>
@endsection
