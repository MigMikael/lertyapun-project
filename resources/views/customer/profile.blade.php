@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            {!! Form::model($customer, ['url' => 'customer/profile', 'method' => 'put', 'files' => 'true']) !!}
            <div class="row">
                <div class="col-md-12">
                    <h5 class="title">ข้อมูลส่วนตัว</h5>
                    <span>จัดการข้อมูลส่วนตัวคุณเพื่อความปลอดภัยของบัญชีผู้ใช้นี้</span>
                    <hr>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ชื่อ</label>
                                {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>นามสกุล</label>
                                {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>อีเมล์</label>
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์</label>
                                {!! Form::text('phone', null, ['placeholder' => 'Phone Number', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="profile-wrapper" class="form-group">
                                <div class="profile-img-upload">
                                    @if($customer->avatarImage != null)
                                    <div class="profile-img-wrapper">
                                        <div class="profile-img" style="background-image: url('{{ url('image/thumbnail/'.$customer->avatarImage->slug) }}');"></div>
                                    </div>
                                    <div class="profile-btn">
                                        {!! Form::label('avatar_image', 'รูปประจำตัว') !!} (ขั้นต่ำ 500 x 500px)
                                        {!! Form::file('avatar_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือกรูป']) !!}
                                        {{-- <button class="btn btn-secondary btn-block">เลือกรูป</button> --}}
                                    </div>
                                    @else
                                    {!! Form::label('avatar_image', 'รูปประจำตัว') !!} (ขั้นต่ำ 500 x 500px)
                                    {!! Form::file('avatar_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
                                    @endif
                                </div>
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
