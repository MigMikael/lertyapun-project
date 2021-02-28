@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
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
                                {!! Form::text('detail', null, ['placeholder' => 'เลขที่/หมู่/ถนน/ซอย', 'class' => 'form-control'. ($errors->has('detail') ? ' is-invalid' : null)]) !!}
                                @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>แขวง/ตำบล</label>
                                {!! Form::text('subDistrict', null, ['placeholder' => 'แขวง/ตำบล', 'class' => 'form-control'. ($errors->has('subDistrict') ? ' is-invalid' : null)]) !!}
                                @error('subDistrict')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>เขต/อำเภอ</label>
                                {!! Form::text('district', null, ['placeholder' => 'เขต/อำเภอ', 'class' => 'form-control'. ($errors->has('district') ? ' is-invalid' : null)]) !!}
                                @error('district')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>จังหวัด</label>
                                {!! Form::text('province', null, ['placeholder' => 'จังหวัด', 'class' => 'form-control'. ($errors->has('province') ? ' is-invalid' : null)]) !!}
                                @error('province')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รหัสไปรษณีย์</label>
                                {!! Form::text('zipcode', null, ['placeholder' => 'รหัสไปรษณีย์', 'class' => 'form-control'. ($errors->has('zipcode') ? ' is-invalid' : null)]) !!}
                                @error('zipcode')
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
