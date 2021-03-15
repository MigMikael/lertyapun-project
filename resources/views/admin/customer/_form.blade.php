<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('first_name', 'ชื่อ') !!}
    {!! Form::text('first_name', null, ['placeholder' => 'ชื่อ', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('last_name', 'นามสกุล') !!}
    {!! Form::text('last_name', null, ['placeholder' => 'นามสกุล', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('phone', 'เบอร์โทรศัพท์') !!}
    {!! Form::text('phone', null, ['placeholder' => 'เบอร์โทรศัพท์', 'class' => 'form-control']) !!}
</div>
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('point', 'Point') !!}
    {!! Form::text('point', null, ['placeholder' => 'Point', 'class' => 'form-control']) !!}
</div> --}}
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status', 'สถานะ') !!}
    {!! Form::select('status', $status, $customer->remark ?? null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('remark', 'หมายเหตุ') !!}
    <textarea name="remark" class="form-control" placeholder="เหตุผลที่เจ้าหน้าที่ไม่อนุมัติการสมัครของผู้ใช้งาน">{{ $customer->remark ?? '' }}</textarea>
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('email', 'อีเมล') !!}
    {!! Form::text('email', null, ['placeholder' => 'อีเมล', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('password', 'รหัสผ่าน') !!}
    {!! Form::password('password', ['placeholder' => 'รหัสผ่าน', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('avatar_image', 'รูปประจำตัว') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('avatar_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>
<div class="form-group">
    {!! Form::label('citizen_card_image', 'รูปเลขที่บัตรประชาชน') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('citizen_card_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>
<div class="form-group">
    {!! Form::label('drug_store_approve_image', 'รูปเลขที่ใบอนุญาติร้านยา') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('drug_store_approve_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>
<div class="form-group">
    {!! Form::label('medical_license_image', 'รูปใบประกอบโรคศิลปะ') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('medical_license_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>
<div class="form-group">
    {!! Form::label('commercial_register_image', 'รูปทะเบียนพาณิชย์') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('commercial_register_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>
<div class="form-group">
    {!! Form::label('juristic_person_image', 'รูปใบรับรองนิติบุคคล') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('juristic_person_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>
<div class="form-group">
    {!! Form::label('vat_register_cert_image', 'รูปใบทะเบียนภาษีมูลค่าเพิ่ม') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('vat_register_cert_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'เลือก']) !!}
</div>

