@extends('template.customer')

@section('content')
<section class="section-login">
    <div class="container">
        <div class="row">
            <div class="login-form-wrapper col-md-12">
                <div style="padding: 25px; background: #FFF;">
                    <h2>รอแอดมินอนุมัตินะครับ</h2>
                    @if($customer->remark != "")
                        <p>{{ $customer->remark }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
