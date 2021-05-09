<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['placeholder' => 'name', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null)]) !!}
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('status') !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : null)]) !!}
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
@include('template._inputPreview', [
    'label' => 'โลโก้บริการขนส่ง',
    'name' => 'delivery_image',
    'key' => 'deliveryImage',
])
