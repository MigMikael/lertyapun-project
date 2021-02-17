<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('first_name', 'FirstName') !!}
    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('last_name', 'LastName') !!}
    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', null, ['placeholder' => 'Phone Number', 'class' => 'form-control']) !!}
</div>
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('point', 'Point') !!}
    {!! Form::text('point', null, ['placeholder' => 'Point', 'class' => 'form-control']) !!}
</div> --}}
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Status') !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('remark', 'Remark') !!}
    <textarea name="remark" class="form-control" placeholder="Admin Remark">{{ $customer->remark ?? '' }}</textarea>
</div>
<hr>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['placeholder' => 'Passowrd', 'class' => 'form-control']) !!}
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

