@extends('template.customer')

@section('content')
<section>
    <div class="container">
        @if(Request::is('customer/pending/*/edit'))
        {!! Form::open(['url' => 'customer/pending/'.$customer->slug, 'method' => 'put', 'files' => 'true']) !!}
        @else
        {!! Form::open(['url' => 'register', 'method' => 'post', 'files' => 'true']) !!}
        @endif
            <div class="row register-wrapper" style="padding: 25px !important;">
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
                    <div class="form-group">
                        <label>อีเมล์ <span class="required">*</span></label>
                        @if(isset($preloadEmail))
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="อีเมล์" value="{{ $preloadEmail }}">
                        @else
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="อีเมล์" value="@if(Request::is('customer/pending/*/edit')){{ $customer->email }}@else{{ old('email') }}@endif">
                        @endif
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

                    <div class="form-group">
                        <label>หมายเลขบัตรประชาชน <span class="required">*</span></label>
                        <input name="citizen_card_id" type="text" class="form-control @error('citizen_card_id') is-invalid @enderror" placeholder="หมายเลขบัตรประชาชน" value="@if(Request::is('customer/pending/*/edit')){{ $customer->citizen_card_id }}@else{{ old('citizen_card_id') }}@endif">
                        @error('citizen_card_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>หมายเลขใบอนุญาติร้านยา <span class="required">*</span></label>
                        <input name="drug_store_id" type="text" class="form-control @error('drug_store_id') is-invalid @enderror" placeholder="หมายเลขใบอนุญาติร้านยา" value="@if(Request::is('customer/pending/*/edit')){{ $customer->drug_store_id }}@else{{ old('drug_store_id') }}@endif">
                        @error('drug_store_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    @include('template._inputPreview', [
                        'label' => 'รูปเลขที่บัตรประชาชน',
                        'name' => 'citizen_card_image',
                        'key' => 'citizenCardImage',
                    ])

                    @include('template._inputPreview', [
                        'label' => 'รูปเลขที่ใบอนุญาติร้านยา',
                        'name' => 'drug_store_approve_image',
                        'key' => 'drugStoreApproveImage',
                    ])

                    @include('template._inputPreview', [
                        'label' => 'รูปใบประกอบโรคศิลปะ',
                        'name' => 'medical_license_image',
                        'key' => 'medicalLicenseImage',
                        'required' => 'true',
                    ])
                </div>
                <div class="col-md-4">
                    @include('template._inputPreview', [
                        'label' => 'รูปทะเบียนพาณิชย์',
                        'name' => 'commercial_register_image',
                        'key' => 'commercialRegisterImage',
                    ])

                    @include('template._inputPreview', [
                        'label' => 'รูปใบรับรองนิติบุคคล',
                        'name' => 'juristic_person_image',
                        'key' => 'juristicPersonImage',
                    ])

                    @include('template._inputPreview', [
                        'label' => 'รูปใบทะเบียนภาษีมูลค่าเพิ่ม',
                        'name' => 'vat_register_cert_image',
                        'key' => 'vatRegisterCertImage',
                    ])
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

{{-- @section('script')
    <script>
        $('#aniimated-thumbnials').lightGallery({
            thumbnail:true
        });
    </script>
@endsection --}}
