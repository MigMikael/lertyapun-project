<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('first_name', 'ชื่อ') !!} <span class="required">*</span>
    {!! Form::text('first_name', null, ['placeholder' => 'ชื่อ', 'class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : null)]) !!}
    @error('first_name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('last_name', 'นามสกุล') !!} <span class="required">*</span>
    {!! Form::text('last_name', null, ['placeholder' => 'นามสกุล', 'class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : null)]) !!}
    @error('last_name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('phone', 'เบอร์โทรศัพท์') !!} <span class="required">*</span>
    {!! Form::text('phone', null, ['placeholder' => 'เบอร์โทรศัพท์', 'class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : null)]) !!}
    @error('phone')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('email', 'อีเมล') !!} <span class="required">*</span>
    {!! Form::text('email', null, ['placeholder' => 'อีเมล', 'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null)]) !!}
    @error('email')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('password', 'รหัสผ่าน') !!} <span class="required">*</span>
    {!! Form::password('password', ['placeholder' => 'รหัสผ่าน', 'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null)]) !!}
    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('citizen_card_id', 'หมายเลขบัตรประชาชน') !!} <span class="required">*</span>
    {!! Form::text('citizen_card_id', null, ['placeholder' => 'หมายเลขบัตรประชาชน', 'class' => 'form-control' . ($errors->has('citizen_card_id') ? ' is-invalid' : null)]) !!}
    @error('citizen_card_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('drug_store_id', 'หมายเลขใบอนุญาติร้านยา') !!} <span class="required">*</span>
    {!! Form::text('drug_store_id', null, ['placeholder' => 'หมายเลขใบอนุญาติร้านยา', 'class' => 'form-control' . ($errors->has('drug_store_id') ? ' is-invalid' : null)]) !!}
    @error('drug_store_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('store_name', 'ชื่อร้านยา') !!} <span class="required">*</span>
    {!! Form::text('store_name', null, ['placeholder' => 'ชื่อร้านยา', 'class' => 'form-control' . ($errors->has('store_name') ? ' is-invalid' : null)]) !!}
    @error('store_name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    <label>เลขที่/หมู่/ถนน/ซอย <span class="required">*</span></label>
    <input name="detail" type="text" class="form-control @error('detail') is-invalid @enderror" placeholder="เลขที่/หมู่/ถนน/ซอย" value="@if(isset($address->detail)){{ $address->detail }}@else{{ old('detail') }}@endif">
    @error('detail')
    <div class="text-danger">{{ $detail }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    <label>แขวง/ตำบล <span class="required">*</span></label>
    <input name="subDistrict" type="text" class="form-control @error('subDistrict') is-invalid @enderror" placeholder="แขวง/ตำบล" value="@if(isset($address->subDistrict)){{ $address->subDistrict }}@else{{ old('subDistrict') }}@endif">
    @error('subDistrict')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    <label>เขต/อำเภอ <span class="required">*</span></label>
    <input name="district" type="text" class="form-control @error('district') is-invalid @enderror" placeholder="เขต/อำเภอ" value="@if(isset($address->district)){{ $address->district }}@else{{ old('district') }}@endif">
    @error('district')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    <label>จังหวัด <span class="required">*</span></label>
    <input name="province" type="text" class="form-control @error('province') is-invalid @enderror" placeholder="จังหวัด" value="@if(isset($address->province)){{ $address->province }}@else{{ old('province') }}@endif">
    @error('province')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    <label>รหัสไปรษณีย์ <span class="required">*</span></label>
    <input name="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" placeholder="รหัสไปรษณีย์" value="@if(isset($address->zipcode)){{ $address->zipcode }}@else{{ old('zipcode') }}@endif">
    @error('zipcode')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status', 'สถานะ') !!} <span class="required">*</span>
    {!! Form::select('status', $status, $customer->remark ?? null, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : null)]) !!}
    @error('status')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<!--
<div class="form-group">
    {!! Form::label('avatar_image', 'รูปประจำตัว') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('avatar_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('avatar_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('avatar_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('citizen_card_image', 'รูปเลขที่บัตรประชาชน') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('citizen_card_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('citizen_card_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('citizen_card_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('drug_store_approve_image', 'รูปเลขที่ใบอนุญาติร้านยา') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('drug_store_approve_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('drug_store_approve_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('drug_store_approve_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('medical_license_image', 'รูปใบประกอบโรคศิลปะ') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('medical_license_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('medical_license_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('medical_license_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('commercial_register_image', 'รูปทะเบียนพาณิชย์') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('commercial_register_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('commercial_register_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('commercial_register_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('juristic_person_image', 'รูปใบรับรองนิติบุคคล') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('juristic_person_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('juristic_person_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('juristic_person_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('vat_register_cert_image', 'รูปใบทะเบียนภาษีมูลค่าเพิ่ม') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('vat_register_cert_image', ['accept'=>'image/*', 'class' => 'form-control' . ($errors->has('vat_register_cert_image') ? ' is-invalid' : null), 'value' => 'เลือก']) !!}
    @error('vat_register_cert_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
-->