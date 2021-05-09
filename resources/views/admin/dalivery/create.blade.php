@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">เพิ่มบริการขนส่ง</h4>
            <span>เจ้าหน้าที่สามารถเพิ่มบริการขนส่ง</span>
        </div>
    </div>
    <hr>
    {!! Form::open(['url' => 'admin/deliveries', 'method' => 'post', 'files' => 'true']) !!}
        @include('admin.dalivery._form')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">เพิ่มบริการขนส่ง</button>
    {!! Form::close() !!}
</div>
@endsection
