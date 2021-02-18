@extends('template.customer')

@section('content')
<section class="section-login">
    <div class="container">
        <div class="row">
            <div class="login-img-wrapper col-md-6">
                <div style="background: #FFF; width: 100%; height: 100%;
                    background-image: url({{ URL::asset('img/login.png') }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;">
                </div>
            </div>
            <div class="login-form-wrapper col-md-6">
                <div style="padding: 25px; background: #FFF;">
                {!! Form::open(['url' => 'login', 'method' => 'post', 'files' => 'true', 'class' => 'form-signin']) !!}
                    <h5>ลงชื่อเข้าใช้งาน</h5>
                    <hr class="my-4">
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input name="email" type="email" class="form-control" placeholder="อีเมล์" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน" required>
                    </div>
                    {{-- <div class="form-group">
                        <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                    </div> --}}
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">เข้าสู่ระบบ</button>
                    <hr class="my-4">
                    <button class="btn btn-lg btn-secondary btn-block text-uppercase" type="button" onclick="location.href='{{ url('register') }}'">สมัครสมาชิก</button>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
