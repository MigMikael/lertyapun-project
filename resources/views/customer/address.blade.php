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
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ที่อยู่</label>
                                {!! Form::text('detail', null, ['placeholder' => 'detail', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>แขวง/ตำบล</label>
                                {!! Form::text('subDistrict', null, ['placeholder' => 'subDistrict', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>เขต/อำเภอ</label>
                                {!! Form::text('district', null, ['placeholder' => 'district', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>จังหวัด</label>
                                {!! Form::text('province', null, ['placeholder' => 'province', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>รหัสไปรษณีย์</label>
                                {!! Form::text('zipcode', null, ['placeholder' => 'zipcode', 'class' => 'form-control']) !!}
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
