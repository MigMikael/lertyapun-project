@extends('template.customer')

@section('content')
<section class="section-login">
    <div class="container">
        <div class="row">
            <div class="card pending-form-wrapper col-md-12">
                <div style="padding: 25px; background: #FFF; text-align: center;">
                    <h5>การสมัครสมาชิกของคุณถูกส่งเข้าระบบแล้ว !</h5>
                    <p>กรุณารอเจ้าหน้าที่ตรวจสอบข้อมูลเพื่อยืนยันการสมัครสมาชิก ระหว่างนี้คุณสามารถแก้ไขข้อมูลของคุณได้</p>
                    @if($customer->remark != "")
                        <p style="color: red;">{{ $customer->remark }}</p>
                    @endif
                    <div class="col-md-12">
                        <img src="{{ url('img/register-success.png') }}" style="width: 400px; max-width: 100%;">
                    </div>
                    <a class="btn btn-secondary" href="{{ url('customer/pending/'. $customer->slug .'/edit') }}">แก้ไขข้อมูล</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer
<footer class="footer bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted text-center" style="margin-top: 5px; margin-bottom: 0px !important;">&copy; LERTYAPHAN 2021. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
-->
@endsection
