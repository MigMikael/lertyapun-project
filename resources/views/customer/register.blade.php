@extends('template.customer')

@section('content')
<section>
    <div class="container">
        @if(Request::is('customer/pending/*/edit'))
        {!! Form::open(['url' => 'customer/pending/'.$customer->slug, 'method' => 'put', 'files' => 'true']) !!}
        @else
        {!! Form::open(['url' => 'register', 'method' => 'post', 'files' => 'true']) !!}
        @endif
            <div class="row register-wrapper">
                <div class="col-md-12">
                    @if(Request::is('customer/pending/*/edit'))
                    <h5>แก้ไขข้อมูลสมัครสมาชิก</h5>
                    @else
                    <h5>สมัครสมาชิก</h5>
                    @endif
                    <hr class="my-4">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>ชื่อ <span class="required">*</span></label>
                        <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="ชื่อ" value="@if(Request::is('customer/pending/*/edit')){{ $customer->first_name }}@else{{ old('first_name') }}@endif">
                        @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>นามสกุล <span class="required">*</span></label>
                        <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="นามสกุล" value="@if(Request::is('customer/pending/*/edit')){{ $customer->last_name }}@else{{ old('last_name') }}@endif">
                        @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทรศัพท์ <span class="required">*</span></label>
                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="เบอร์โทรศัพท์" value="@if(Request::is('customer/pending/*/edit')){{ $customer->phone }}@else{{ old('phone') }}@endif">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr class="my-4">
                    <div class="form-group">
                        <label>อีเมล์ <span class="required">*</span></label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="อีเมล์" value="@if(Request::is('customer/pending/*/edit')){{ $customer->email }}@else{{ old('email') }}@endif">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(Request::is('customer/pending/*/edit'))
                        <div class="form-group">
                            <label>รหัสผ่านปัจจุบัน <span class="required">*</span></label>
                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" placeholder="รหัสผ่านปัจจุบัน">
                            @error('old_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>รหัสผ่านใหม่</label>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="รหัสผ่านใหม่">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>ยืนยันรหัสผ่านใหม่</label>
                            <input name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="ยืนยันรหัสผ่านใหม่">
                            @error('confirm_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="form-group">
                            <label>รหัสผ่าน <span class="required">*</span></label>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="รหัสผ่าน">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>ยืนยันรหัสผ่าน <span class="required">*</span></label>
                            <input name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="ยืนยันรหัสผ่าน">
                            @error('confirm_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="mb-0 pb-2">รูปเลขที่บัตรประชาชน <span class="required">*</span></label>
                    <div class="border mb-4 p-1 rounded @error('citizen_card_image') border-danger @enderror">
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/x-png,image/gif,image/jpeg" name="citizen_card_image" type="file"
                                    onchange="document.getElementById('citizen_card_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center image-preview">
                            <img src="@if(Request::is('customer/pending/*/edit')) {{ url('image/thumbnail/'.$customer->citizenCardImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="citizen_card_image"/>
                        </div>
                    </div>
                    <label class="mb-0 pb-2">รูปเลขที่ใบอนุญาติร้านยา <span class="required">*</span></label>
                    <div class="border mb-4 p-1 rounded @error('drug_store_approve_image') border-danger @enderror">
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/x-png,image/gif,image/jpeg" name="drug_store_approve_image" type="file"
                                    onchange="document.getElementById('drug_store_approve_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center image-preview">
                            <img src="@if(Request::is('customer/pending/*/edit')) {{ url('image/thumbnail/'.$customer->drugStoreApproveImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="drug_store_approve_image" />
                        </div>
                    </div>
                    <label class="mb-0 pb-2">รูปใบประกอบโรคศิลปะ <span class="required">*</span></label>
                    <div class="border mb-4 p-1 rounded @error('medical_license_image') border-danger @enderror">
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/x-png,image/gif,image/jpeg" name="medical_license_image" type="file"
                                    onchange="document.getElementById('medical_license_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center image-preview">
                            <img src="@if(Request::is('customer/pending/*/edit')) {{ url('image/thumbnail/'.$customer->medicalLicenseImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="medical_license_image" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="mb-0 pb-2">รูปทะเบียนพาณิชย์</label>
                    <div class="border mb-4 p-1 rounded @error('commercial_register_image') border-danger @enderror">
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/x-png,image/gif,image/jpeg" name="commercial_register_image" type="file"
                                    onchange="document.getElementById('commercial_register_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center image-preview">
                            <img src="@if(Request::is('customer/pending/*/edit') && $customer->commercialRegisterImage != null) {{ url('image/thumbnail/'.$customer->commercialRegisterImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="commercial_register_image" />
                        </div>
                    </div>
                    <label class="mb-0 pb-2">รูปใบรับรองนิติบุคคล</label>
                    <div class="border mb-4 p-1 rounded @error('juristic_person_image') border-danger @enderror">
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/x-png,image/gif,image/jpeg" name="juristic_person_image" type="file"
                                    onchange="document.getElementById('juristic_person_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center image-preview">
                            <img src="@if(Request::is('customer/pending/*/edit') && $customer->juristicPersonImage != null) {{ url('image/thumbnail/'.$customer->juristicPersonImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="juristic_person_image" />
                        </div>
                    </div>
                    <label class="mb-0 pb-2">รูปใบทะเบียนภาษีมูลค่าเพิ่ม</label>
                    <div class="border mb-4 p-1 rounded @error('vat_register_cert_image') border-danger @enderror">
                        <div class="input-group">
                            <div class="custom-file">
                                <input accept="image/x-png,image/gif,image/jpeg" name="vat_register_cert_image" type="file"
                                    onchange="document.getElementById('vat_register_cert_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center image-preview">
                            <img src="@if(Request::is('customer/pending/*/edit') && $customer->vatRegisterCertImage != null) {{ url('image/thumbnail/'.$customer->vatRegisterCertImage->slug) }} @else{{ URL::asset('img/placeholder-image.jpg') }}@endif" id="vat_register_cert_image" />
                        </div>
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
