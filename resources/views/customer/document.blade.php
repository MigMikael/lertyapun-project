@extends('template.customer')

@section('content')
<div class="wrapper d-flex align-items-stretch">
    @include('customer._sidebar')
    <nav id="content">
        <div style="padding: 50px;">
            {!! Form::model($customer, ['url' => 'customer/document', 'method' => 'put', 'files' => 'true']) !!}
            <div class="row">
                <div class="col-md-12">
                    <h5 class="title">เอกสาร</h5>
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
                        <div class="col-md-12">
                            <label class="mb-0 pb-2">รูปเลขที่บัตรประชาชน <span class="required">*</span></label>
                            <div class="border mb-4 p-1 rounded @error('citizen_card_image') border-danger @enderror">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input accept="image/x-png,image/gif,image/jpeg" name="citizen_card_image" type="file"
                                            onchange="document.getElementById('citizen_card_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('citizen_card_image_pre').href = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                                <div class="rounded-lg text-center image-preview">
                                    <a id="citizen_card_image_pre" href="@if($customer->citizenCardImage !== null) {{ url('image/show/'.$customer->citizenCardImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif">
                                        <img src="@if($customer->citizenCardImage !== null) {{ url('image/show/'.$customer->citizenCardImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="citizen_card_image"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0 pb-2">รูปเลขที่ใบอนุญาติร้านยา <span class="required">*</span></label>
                            <div class="border mb-4 p-1 rounded @error('drug_store_approve_image') border-danger @enderror">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input accept="image/x-png,image/gif,image/jpeg" name="drug_store_approve_image" type="file"
                                            onchange="document.getElementById('drug_store_approve_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('drug_store_approve_image_pre').href = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                                <div class="rounded-lg text-center image-preview">
                                    <a id="drug_store_approve_image_pre" href="@if($customer->drugStoreApproveImage !== null) {{ url('image/show/'.$customer->drugStoreApproveImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif">
                                        <img src="@if($customer->drugStoreApproveImage !== null) {{ url('image/show/'.$customer->drugStoreApproveImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="drug_store_approve_image" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0 pb-2">รูปใบประกอบโรคศิลปะ <span class="required">*</span></label>
                            <div class="border mb-4 p-1 rounded @error('medical_license_image') border-danger @enderror">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input accept="image/x-png,image/gif,image/jpeg" name="medical_license_image" type="file"
                                            onchange="document.getElementById('medical_license_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('medical_license_image_pre').href = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                                <div class="rounded-lg text-center image-preview">
                                    <a id="medical_license_image_pre" href="@if($customer->medicalLicenseImage !== null) {{ url('image/show/'.$customer->medicalLicenseImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif">
                                        <img src="@if($customer->medicalLicenseImage !== null) {{ url('image/show/'.$customer->medicalLicenseImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="medical_license_image" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="mb-0 pb-2">รูปทะเบียนพาณิชย์</label>
                            <div class="border mb-4 p-1 rounded @error('commercial_register_image') border-danger @enderror">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input accept="image/x-png,image/gif,image/jpeg" name="commercial_register_image" type="file"
                                            onchange="document.getElementById('commercial_register_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('commercial_register_image_pre').href = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                                <div class="rounded-lg text-center image-preview">
                                    <a id="commercial_register_image_pre" href="@if($customer->commercialRegisterImage !== null) {{ url('image/show/'.$customer->commercialRegisterImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif">
                                        <img src="@if($customer->commercialRegisterImage !== null) {{ url('image/show/'.$customer->commercialRegisterImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="commercial_register_image" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0 pb-2">รูปใบรับรองนิติบุคคล</label>
                            <div class="border mb-4 p-1 rounded @error('juristic_person_image') border-danger @enderror">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input accept="image/x-png,image/gif,image/jpeg" name="juristic_person_image" type="file"
                                            onchange="document.getElementById('juristic_person_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('juristic_person_image_pre').href = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                                <div class="rounded-lg text-center image-preview">
                                    <a id="juristic_person_image_pre" href="@if($customer->juristicPersonImage !== null) {{ url('image/show/'.$customer->juristicPersonImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif">
                                        <img src="@if($customer->juristicPersonImage !== null) {{ url('image/show/'.$customer->juristicPersonImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="juristic_person_image" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0 pb-2">รูปใบทะเบียนภาษีมูลค่าเพิ่ม</label>
                            <div class="border mb-4 p-1 rounded @error('vat_register_cert_image') border-danger @enderror">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input accept="image/x-png,image/gif,image/jpeg" name="vat_register_cert_image" type="file"
                                        onchange="document.getElementById('vat_register_cert_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('vat_register_cert_image_pre').href = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                                <div class="rounded-lg text-center image-preview">
                                    <a id="vat_register_cert_image_pre" href="@if($customer->vatRegisterCertImage !== null) {{ url('image/show/'.$customer->vatRegisterCertImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif">
                                        <img src="@if($customer->vatRegisterCertImage !== null) {{ url('image/show/'.$customer->vatRegisterCertImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="vat_register_cert_image" />
                                    </a>
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
