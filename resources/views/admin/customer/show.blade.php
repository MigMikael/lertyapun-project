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
                <strong>
                    ข้อมูลส่วนตัว
                </strong>
            </div>
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
                <p>หมายเลขบัตรประชาชน: {{ $customer->citizen_card_id }}</p>
            </div>
            <div class="form-group">
                <p>หมายเลขใบอนุญาติร้านยา: {{ $customer->drug_store_id }}</p>
            </div>
            <div class="form-group">
                <p>สถานะ: @if($customer->status == 'active')
                    <span class="badge badge-success">กำลังใช้งาน</span>
                    @elseif($customer->status == 'pending')
                    <span class="badge badge-warning">รอดำเนินการ</span>
                    @elseif($customer->status == 'suspend')
                    <span class="badge badge-danger-secondary">ระงับการใช้งาน</span>
                    @elseif($customer->status == 'inactive')
                    <span class="badge badge-danger">รีเซ็ตรหัสผ่าน</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8 col-xs-6" style="border: 0px solid black;">
            <div class="form-group">
                <strong>
                    ข้อมูลที่อยู่
                </strong>
            </div>
            <div class="form-group">
                <p>
                    ที่อยู่: {{ $address->detail }}
                </p>
            </div>
            <div class="form-group">
                <p>
                    ตำบล/แขวง: {{ $address->subDistrict }}
                </p>
            </div>
            <div class="form-group">
                <p>
                    อำเภอ/เขต {{ $address->district }}
                </p>
            </div>
            <div class="form-group">
                <p>
                    จังหวัด: {{ $address->province }}
                </p>
            </div>
            <div class="form-group">
                <p>
                    รหัสไปรษณีย์: {{ $address->zipcode }}
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>
                    ข้อมูลเอกสาร
                </strong>
            </div>
        </div>
    </div>
    <div id="aniimated-thumbnials" class="row">
        @if ($customer->citizenCardImage == null && $customer->drugStoreApproveImage == null && $customer->medicalLicenseImage == null &&
        $customer->commercialRegisterImage == null && $customer->juristicPersonImage == null && $customer->vatRegisterCertImage == null)
        <div class="col-md-12">
            <span>ไม่พบข้อมูล</span>
        </div>
        @endif

        @if ($customer->citizenCardImage != null)
        <a class="col-md-6 col-lg-4 form-group" href="{{ url('image/show/'.$customer->citizenCardImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->citizenCardImage->slug) }}" style="width: 100%; height: 250px;" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->drugStoreApproveImage != null)
        <a class="col-md-6 col-lg-4 form-group" href="{{ url('image/show/'.$customer->drugStoreApproveImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->drugStoreApproveImage->slug) }}" style="width: 100%; height: 250px;" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->medicalLicenseImage != null)
        <a class="col-md-6 col-lg-4 form-group" href="{{ url('image/show/'.$customer->medicalLicenseImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->medicalLicenseImage->slug) }}" style="width: 100%; height: 250px;" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->commercialRegisterImage != null)
        <a class="col-md-6 col-lg-4 form-group" href="{{ url('image/show/'.$customer->commercialRegisterImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->commercialRegisterImage->slug) }}" style="width: 100%; height: 250px;" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->juristicPersonImage != null)
        <a class="col-md-6 col-lg-4 form-group" href="{{ url('image/show/'.$customer->juristicPersonImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->juristicPersonImage->slug) }}" style="width: 100%; height: 250px;" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif

        @if ($customer->vatRegisterCertImage != null)
        <a class="col-md-6 col-lg-4 form-group" href="{{ url('image/show/'.$customer->vatRegisterCertImage->slug) }}">
            <img src="{{ url('image/show/'.$customer->vatRegisterCertImage->slug) }}" style="width: 100%; height: 250px;" class="img-fluid" alt="{{ $customer->first_name }}">
        </a>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>
                    จัดการผู้ใช้งาน
                </strong>
            </div>
        </div>
        <div class="col-md-12">
            {!! Form::model($customer, ['url' => 'admin/customers/'.$customer->slug.'/status', 'method' => 'put', 'files' => 'true']) !!}
            <div class="form-group">
                {!! Form::label('Status', 'สถานะ') !!}
                {!! Form::select('status', $status, $customer->status, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('remark', 'หมายเหตุ') !!}
                <textarea name="remark" rows="5" class="form-control" placeholder="โปรดระบุเหตุผลหากไม่อนุมัติผู้ใช้งาน">{{ $customer->remark ?? '' }}</textarea>
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
        thumbnail: true
    });
</script>
@endsection