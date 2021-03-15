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
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success', 'Success !') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('fail', 'Fail !') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รหัสผ่านปัจจุบัน</label>
                                {!! Form::password('current_password', ['placeholder' => 'รหัสผ่านปัจจุบัน', 'class' => 'form-control'. ($errors->has('current_password') ? ' is-invalid' : null)]) !!}
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รหัสผ่านใหม่</label>
                                {!! Form::password('new_password', ['placeholder' => 'รหัสผ่านใหม่', 'class' => 'form-control'. ($errors->has('new_password') ? ' is-invalid' : null)]) !!}
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ยืนยันรหัสผ่านใหม่</label>
                                {!! Form::password('confirm_new_password', ['placeholder' => 'ยืนยันรหัสผ่านใหม่', 'class' => 'form-control'. ($errors->has('confirm_new_password') ? ' is-invalid' : null)]) !!}
                                @error('confirm_new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
