<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'ชื่อประเภทสินค้า') !!}
    {!! Form::text('name', null, ['placeholder' => 'ชื่อประเภทสินค้า', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null)]) !!}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
