@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        {!! Form::model($customer, ['url' => 'customer/profile', 'method' => 'put', 'files' => 'true']) !!}
        <div class="row">
            <div class="col-md-12">
                <h5 class="title">ข้อมูลส่วนตัว</h5>
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
                    <div class="col-lg-12">
                        <div id="profile-wrapper" class="form-group">
                            <div class="profile-img-upload">
                                <div class="profile-img-wrapper">
                                    @if($customer->avatarImage != null)
                                        <img id="profile-img" class="profile-img" src="{{ url('image/show/'.$customer->avatarImage->slug) }}">
                                    @else
                                        <img id="profile-img" class="profile-img" src="{{ url('img/avatar.png') }}">
                                    @endif
                                </div>
                                <label class="btn btn-primary profile-btn">
                                    <i class="fa fa-image"></i> 
                                    @if($customer->avatarImage != null)
                                    แก้ไขรูปประจำตัว
                                    @else
                                    เพิ่มรูปประจำตัว
                                    @endif
                                    {!! Form::file('avatar_image', ['accept'=>'image/*', 'id' => 'upload-profile-img', 'class' => 'form-control hidden',
                                    'value' => 'เลือกรูป']) !!}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            {!! Form::text('first_name', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('first_name') ? ' is-invalid' : null)]) !!}
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>นามสกุล</label>
                            {!! Form::text('last_name', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('last_name') ? ' is-invalid' : null)]) !!}
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>อีเมล</label>
                            {!! Form::text('email', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('email') ? ' is-invalid' : null)]) !!}
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            {!! Form::text('phone', null, ['placeholder' => '', 'class' => 'form-control'.
                            ($errors->has('phone') ? ' is-invalid' : null)]) !!}
                            @error('phone')
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
</div>
@endsection

@section('script')
<script>
    function changeImgUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#profile-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#upload-profile-img").change(function(){
        changeImgUrl(this);
    });
</script>
@endsection