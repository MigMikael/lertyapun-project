@extends('template.customer')

@section('content')
<section class="section-login">
    <div class="container">
        <div class="card mx-auto login-form-wrapper">
            <div class="login-wrapper">
                {!! Form::open(['url' => 'login', 'method' => 'post', 'files' => 'true', 'class' => 'form-signin']) !!}
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
                <div class="row">
                    <div class="col-md-12">
                        <h5>ลงชื่อเข้าใช้งาน</h5>
                        <hr class="my-4">
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>อีเมล</label>
                            <input name="email" type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>รหัสผ่าน</label>
                            <input name="password" type="password" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">เข้าสู่ระบบ</button>
                        <hr class="my-4">
                        <button class="btn btn-lg btn-secondary btn-block text-uppercase" type="button"
                        onclick="location.href='{{ url('register') }}'">สมัครสมาชิก</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="footer bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted text-center" style="margin-top: 5px; margin-bottom: 0px !important;">&copy;
                    LERTYAPHAN 2021. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
@endsection