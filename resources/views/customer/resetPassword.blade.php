@extends('template.customer')

@section('content')
<section>
    <div class="container">
        {!! Form::open(['url' => 'customer/password/'.$customer->slug.'/reset', 'method' => 'put']) !!}
            <div class="row register-wrapper">
                <div class="col-md-12">
                    <h5>ตั้งรหัสผ่านใหม่</h5>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>รหัสผ่านใหม่</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="รหัสผ่านใหม่">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>ยืนยันรหัสผ่านใหม่</label>
                        <input name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" value="{{ old('confirm_password') }}" placeholder="ยืนยันรหัสผ่านใหม่">
                        @error('confirm_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="my-4">
                </div>
                <div class="col-md-6 mx-auto">
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">ยืนยัน</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection
