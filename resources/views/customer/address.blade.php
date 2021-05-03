@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        {!! Form::model($address, ['url' => 'customer/address', 'method' => 'put']) !!}
        <div class="row">
            <div class="col-md-12">
                <h5 class="title">ที่อยู่</h5>
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
                            <label>เลขที่/หมู่/ถนน/ซอย</label>
                            {!! Form::text('detail', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('detail') ? ' is-invalid' : null)]) !!}
                            @error('detail')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>แขวง/ตำบล</label>
                            {!! Form::text('subDistrict', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('subDistrict') ? ' is-invalid' : null)]) !!}
                            @error('subDistrict')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>เขต/อำเภอ</label>
                            {!! Form::text('district', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('district') ? ' is-invalid' : null)]) !!}
                            @error('district')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            {!! Form::text('province', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('province') ? ' is-invalid' : null)]) !!}
                            @error('province')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>รหัสไปรษณีย์</label>
                            {!! Form::text('zipcode', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('zipcode') ? ' is-invalid' : null)]) !!}
                            @error('zipcode')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-submit">
            <div class="btn-submit-wrapper">
                <button id="btn-submit" class="btn btn-primary">ยืนยัน</button>
            </div>
        </div>
        {!! Form::close() !!}
    </nav>
</div>
@endsection