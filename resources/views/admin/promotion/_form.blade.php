<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'ชื่อโปรโมชัน') !!}
    {!! Form::text('name', null, ['placeholder' => 'ชื่อโปรโมชัน', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null)]) !!}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('ประเภท') !!}
    {!! Form::select('type', $type, null, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : null)]) !!}
    @error('type')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
{{-- <div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Valid From', 'วันที่เริ่มต้นโปรโมชัน') !!}
    {!! Form::date('valid_start', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('valid_start')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Valid To', 'วันที่สิ้นสุดโปรโมชัน') !!}
    {!! Form::date('valid_end', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    @error('valid_end')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div> --}}
