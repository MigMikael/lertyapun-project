<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'ชื่อ') !!} <span class="required">*</span>
    {!! Form::text('name', null, ['placeholder' => 'ชื่อ', 'class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : null)]) !!}
    @error('name')
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
