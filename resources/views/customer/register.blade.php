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
                        <input name="first_name" type="text" id="fname" class="form-control" placeholder="ชื่อ" required>
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
                    <div class="form-group">
                        <label>รูปเลขที่บัตรประชาชน <span class="required">*</span></label>
                        <input name="citizen_card_image" type="file" id="card_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>รูปเลขที่ใบอนุญาติร้านยา <span class="required">*</span></label>
                        <input name="drug_store_approve_image" type="file" id="license_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>รูปใบประกอบโรคศิลปะ <span class="required">*</span></label>
                        <input name="medical_license_image" type="file" id="license_art_file" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>รูปทะเบียนพาณิชย์</label>
                        <input name="commercial_register_image" type="file" id="license_art_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>รูปใบรับรองนิติบุคคล </label>
                        <input name="juristic_person_image" type="file" id="corp_license_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>รูปใบทะเบียนภาษีมูลค่าเพิ่ม</label>
                        <input name="vat_register_cert_image" type="file" id="tax_file" class="form-control" required>
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
