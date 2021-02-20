@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            {!! Form::model($customer, ['url' => 'customer/password', 'method' => 'put']) !!}
            <div class="row">
                <div class="col-md-12">
                    <h5 class="title">รหัสผ่าน</h5>
                    <span>จัดการข้อมูลส่วนตัวคุณเพื่อความปลอดภัยของบัญชีผู้ใช้นี้</span>
                    <hr>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รหัสผ่านปัจจุบัน</label>
                                {!! Form::password('current_password', ['placeholder' => 'Current Passowrd', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รหัสผ่านใหม่</label>
                                {!! Form::password('new_password', ['placeholder' => 'New Passowrd', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ยืนยันรหัสผ่านใหม่</label>
                                {!! Form::password('confirm_new_password', ['placeholder' => 'Confirm New Passowrd', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6" style="margin-top: 15px;">
                    <button class="btn btn-primary btn-block">ยืนยัน</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </nav>
</div>
@endsection
