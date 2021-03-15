@extends('template.admin')

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">แก้ไขข้อมูลโปรโมชัน</h4>
            <span>เจ้าหน้าที่สามารถแก้ไขข้อมูลโปรโมชัน</span>
        </div>
    </div>
    <hr>
    {!! Form::model($promotion, ['url' => 'admin/promotions/'.$promotion->slug, 'method' => 'put', 'files' => 'true']) !!}
        @include('admin.promotion._form')
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 25px;">แก้ไขข้อมูลโปรโมชัน</button>
    {!! Form::close() !!}
</div>
@endsection
