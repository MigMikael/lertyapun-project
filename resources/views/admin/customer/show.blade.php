@extends('template.admin')

@section('head')
<link href="{{ URL::asset('css/lightgallery.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/lightgallery-all.min.js') }}"></script>
@endsection

@section('content')
<div class="admin-container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="title">ข้อมูลบัญชีผู้ใช้งาน</h4>
            <span>เจ้าหน้าที่สามารถดูข้อมูลผู้ใช้งานและสามารถอนุมัติผู้ใช้งานได้</span>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-xs-6" style="border: 0px solid black;">
            <div class="form-group">
                <p>
                    ชื่อ: {{ $customer->first_name }} {{ $customer->last_name }}
                </p>
            </div>
            <div class="form-group">
                <p>อีเมล: {{ $customer->email }}</p>
            </div>
            <div class="form-group">
                <p>เบอร์โทรศัพท์: {{ $customer->phone }}</p>
            </div>
            <div class="form-group">
                <p>สถานะ: @if($customer->status == 'active')
                    <span class="badge badge-success">กำลังใช้งาน</span>
                @elseif($customer->status == 'pending')
                    <span class="badge badge-warning">รอดำเนินการ</span>
                @elseif($customer->status == 'suspend')
                    <span class="badge badge-secondary">ระงับการใช้งาน</span>
                @elseif($customer->status == 'inactive')
                    <span class="badge badge-danger">รีเซ็ตรหัสผ่าน</span>
                @endif</p>
            </div>
        </div>
    </div>
    <hr>
    <div id="aniimated-thumbnials" class="row">
        @if ($customer->citizenCardImage != null)
        <a class="col-md-2" href="{{ url('image/show/'.$customer->citizenCardImage->slug) }}">
            <img src="{{ url('image/thumbnail/'.$customer->citizenCardImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->drugStoreApproveImage != null)
        <a class="col-md-2" href="{{ url('image/show/'.$customer->drugStoreApproveImage->slug) }}">
            <img src="{{ url('image/thumbnail/'.$customer->drugStoreApproveImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->medicalLicenseImage != null)
        <a class="col-md-2" href="{{ url('image/show/'.$customer->medicalLicenseImage->slug) }}">
            <img src="{{ url('image/thumbnail/'.$customer->medicalLicenseImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->commercialRegisterImage != null)
        <a class="col-md-2" href="{{ url('image/show/'.$customer->commercialRegisterImage->slug) }}">
            <img src="{{ url('image/thumbnail/'.$customer->commercialRegisterImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->juristicPersonImage != null)
        <a class="col-md-2" href="{{ url('image/show/'.$customer->juristicPersonImage->slug) }}">
            <img src="{{ url('image/thumbnail/'.$customer->juristicPersonImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->vatRegisterCertImage != null)
        <a class="col-md-2" href="{{ url('image/show/'.$customer->vatRegisterCertImage->slug) }}">
            <img src="{{ url('image/thumbnail/'.$customer->vatRegisterCertImage->slug) }}" style="width: 100%" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            {!! Form::model($customer, ['url' => 'admin/customers/'.$customer->slug.'/status', 'method' => 'put', 'files' => 'true']) !!}
            <div class="form-group">
                {!! Form::label('Status', 'สถานะ') !!}
                {!! Form::select('status', $status, $customer->status, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('remark', 'หมายเหตุ') !!}
                <textarea name="remark" class="form-control" placeholder="เหตุผลที่เจ้าหน้าที่ไม่อนุมัติการสมัครของผู้ใช้งาน">{{ $customer->remark ?? '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ยืนยัน</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#aniimated-thumbnials').lightGallery({
            thumbnail:true
        });
    </script>
@endsection
