@extends('template.customer')

@section('content')
<style>
    input[type=checkbox] {
    width: 20px;
    height: 20px;
    margin-right: 5px;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 1px solid #000;
}

input[type=checkbox]:checked {
    background-color: #FFF;
}

input[type=checkbox]:checked:after {
    margin-left: 4px;
    margin-top: 0;
    margin-bottom: 5px;
    width: 10px;
    height: 15px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    content: "";
    display: inline-block;
}

.section-register {
    padding-top: 150px !important;
}

@media (max-width: 767.98px) {
    .section-register {
        padding-top: 120px !important;
    }
}
</style>
<section class="section-register">
    <div class="container">
        <div class="card mx-auto register-form-wrapper">
            <div class="register-wrapper">
            @if(Request::is('customer/pending/*/edit'))
            {!! Form::open(['url' => 'customer/pending/'.$customer->slug, 'method' => 'put', 'files' => 'true']) !!}
            @else
            {!! Form::open(['url' => 'register', 'method' => 'post', 'files' => 'true']) !!}
            @endif
           <div class="row">
               <div class="col-md-12">
                @if(Request::is('customer/pending/*/edit'))
                <h5>แก้ไขข้อมูลสมัครสมาชิก</h5>
                @else
                <h5>สมัครสมาชิก</h5>
                @endif
                <hr class="my-4">
               </div>
               <div class="col-md-12">
                   <div class="form-group">
                        <strong>ข้อมูลส่วนตัว</strong>
                   </div>
               </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label>ชื่อ <span class="required">*</span></label>
                    <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $customer->first_name }}@else{{ old('first_name') }}@endif">
                    @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label>นามสกุล <span class="required">*</span></label>
                    <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $customer->last_name }}@else{{ old('last_name') }}@endif">
                    @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label>อีเมล <span class="required">*</span></label>
                    @if(isset($preloadEmail))
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{ $preloadEmail }}">
                    @else
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $customer->email }}@else{{ old('email') }}@endif">
                    @endif
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label>เบอร์โทรศัพท์ <span class="required">*</span></label>
                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $customer->phone }}@else{{ old('phone') }}@endif">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>รหัสผ่าน <span class="required">*</span></label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ยืนยันรหัสผ่าน <span class="required">*</span></label>
                        <input name="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="">
                        @error('confirm_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>หมายเลขบัตรประชาชน <span class="required">*</span></label>
                        <input name="citizen_card_id" type="text" class="form-control @error('citizen_card_id') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $customer->citizen_card_id }}@else{{ old('citizen_card_id') }}@endif">
                        @error('citizen_card_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>หมายเลขใบอนุญาตร้านยา <span class="required">*</span></label>
                        <input name="drug_store_id" type="text" class="form-control @error('drug_store_id') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $customer->drug_store_id }}@else{{ old('drug_store_id') }}@endif">
                        @error('drug_store_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="my-4">
                    <div class="form-group">
                         <strong>ข้อมูลเอกสาร</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('template._inputPreview', [
                        'label' => 'รูปบัตรประชาชน',
                        'name' => 'citizen_card_image',
                        'key' => 'citizenCardImage',
                        'required' => true
                    ])
                </div>
                <div class="col-md-6">
                    @include('template._inputPreview', [
                        'label' => 'รูปใบอนุญาตร้านยา',
                        'name' => 'drug_store_approve_image',
                        'key' => 'drugStoreApproveImage',
                        'required' => true
                    ])
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="checkbox" id="optional-check" value="">
                        <label>เอกสารเพิ่มเติม (กรณีมีเอกสาร)</label>
                    </div>
                </div>
                <div class="col-md-12 hidden" id="optional-document">
                    <div class="row">
                        <div class="col-md-6">
                            @include('template._inputPreview', [
                                'label' => 'รูปใบประกอบโรคศิลปะ',
                                'name' => 'medical_license_image',
                                'key' => 'medicalLicenseImage',
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('template._inputPreview', [
                                'label' => 'รูปใบทะเบียนพาณิชย์',
                                'name' => 'commercial_register_image',
                                'key' => 'commercialRegisterImage',
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('template._inputPreview', [
                                'label' => 'รูปใบรับรองนิติบุคคล',
                                'name' => 'juristic_person_image',
                                'key' => 'juristicPersonImage',
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('template._inputPreview', [
                                'label' => 'รูปใบทะเบียนภาษีมูลค่าเพิ่ม',
                                'name' => 'vat_register_cert_image',
                                'key' => 'vatRegisterCertImage',
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="my-4">
                            <div class="form-group">
                                 <strong>ข้อมูลที่อยู่</strong>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>เลขที่/หมู่/ถนน/ซอย <span class="required">*</span></label>
                                <input name="detail" type="text" class="form-control @error('detail') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $address->detail }}@else{{ old('detail') }}@endif">
                                @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>แขวง/ตำบล <span class="required">*</span></label>
                                <input name="subDistrict" type="text" class="form-control @error('subDistrict') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $address->subDistrict }}@else{{ old('subDistrict') }}@endif">
                                @error('subDistrict')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>เขต/อำเภอ <span class="required">*</span></label>
                                <input name="district" type="text" class="form-control @error('district') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $address->district }}@else{{ old('district') }}@endif">
                                @error('district')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>จังหวัด <span class="required">*</span></label>
                                <input name="province" type="text" class="form-control @error('province') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $address->province }}@else{{ old('province') }}@endif">
                                @error('province')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>รหัสไปรษณีย์ <span class="required">*</span></label>
                                <input name="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" placeholder="" value="@if(Request::is('customer/pending/*/edit')){{ $address->zipcode }}@else{{ old('zipcode') }}@endif">
                                @error('zipcode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-auto" style="margin-top: 25px;">
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">ยืนยัน</button>
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
                <p class="text-muted text-center" style="margin-top: 5px; margin-bottom: 0px !important;">&copy; LERTYAPHAN 2021. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
@endsection

@section('script')
<script>
    $( document ).ready(function() {
        if ($('#optional-check').prop('checked')) {
            $('#optional-document').removeClass("hidden");
        } else {
            $('#optional-document').addClass("hidden");
        }
    });

    $("#optional-check").change(function () {
        if ($(this).prop('checked')) {
            $('#optional-document').removeClass("hidden");
        } else {
            $('#optional-document').addClass("hidden");
        }
    });
</script>
@endsection
