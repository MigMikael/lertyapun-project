@extends('template.customer')

@section('content')
<section>
    <div class="container">
        {!! Form::open(['url' => 'register', 'method' => 'post', 'files' => 'true']) !!}
            <div class="row register-wrapper">
                <div class="col-md-12">
                    <h5>สมัครสมาชิก</h5>
                    <hr class="my-4">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>ชื่อ <span class="required">*</span></label>
                        <input name="first_name" type="text" id="fname" class="form-control  is-invalid" placeholder="ชื่อ" required>
                    </div>
                    <div class="form-group">
                        <label>นามสกุล <span class="required">*</span></label>
                        <input name="last_name" type="text" id="lname" class="form-control" placeholder="นามสกุล" required>
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทรศัพท์ <span class="required">*</span></label>
                        <input name="phone" type="text" id="tel" class="form-control" placeholder="เบอร์โทรศัพท์" required>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>อีเมล์ <span class="required">*</span></label>
                        <input name="email" type="email" id="email" class="form-control" placeholder="อีเมล์" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน <span class="required">*</span></label>
                        <input name="password" type="password" id="password" class="form-control" placeholder="รหัสผ่าน" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="mb-0 pb-0">รูปเลขที่บัตรประชาชน <span class="required">*</span></label>
                    <div class="border mb-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input required name="citizen_card_image" type="file" onchange="document.getElementById('citizen_card_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center" style="background-color: #f4f4f4">
                            <img src="{{ URL::asset('img/placeholder-image.jpg') }}" id="citizen_card_image" height="100" />
                        </div>
                    </div>
                    <label class="mb-0 pb-0">รูปเลขที่ใบอนุญาติร้านยา <span class="required">*</span></label>
                    <div class="border mb-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input required name="drug_store_approve_image" type="file" onchange="document.getElementById('drug_store_approve_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center" style="background-color: #f4f4f4">
                            <img src="{{ URL::asset('img/placeholder-image.jpg') }}" id="drug_store_approve_image" height="100" />
                        </div>
                    </div>
                    <label class="mb-0 pb-0">รูปใบประกอบโรคศิลปะ <span class="required">*</span></label>
                    <div class="border mb-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input required name="medical_license_image" type="file" onchange="document.getElementById('medical_license_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center" style="background-color: #f4f4f4">
                            <img src="{{ URL::asset('img/placeholder-image.jpg') }}" id="medical_license_image" height="100" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="mb-0 pb-0">รูปทะเบียนพาณิชย์</label>
                    <div class="border mb-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="commercial_register_image" type="file" onchange="document.getElementById('commercial_register_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center" style="background-color: #f4f4f4">
                            <img src="{{ URL::asset('img/placeholder-image.jpg') }}" id="commercial_register_image" height="100" />
                        </div>
                    </div>
                    <label class="mb-0 pb-0">รูปใบรับรองนิติบุคคล</label>
                    <div class="border mb-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="juristic_person_image" type="file" onchange="document.getElementById('juristic_person_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center" style="background-color: #f4f4f4">
                            <img src="{{ URL::asset('img/placeholder-image.jpg') }}" id="juristic_person_image" height="100" />
                        </div>
                    </div>
                    <label class="mb-0 pb-0">รูปใบทะเบียนภาษีมูลค่าเพิ่ม</label>
                    <div class="border mb-4">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="vat_register_cert_image" type="file" onchange="document.getElementById('vat_register_cert_image').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="rounded-lg text-center" style="background-color: #f4f4f4">
                            <img src="{{ URL::asset('img/placeholder-image.jpg') }}" id="vat_register_cert_image" height="100" />
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
