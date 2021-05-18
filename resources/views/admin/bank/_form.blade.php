<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('account_no', 'account_no') !!}
    {!! Form::text('account_no', null, ['placeholder' => 'account_no', 'class' => 'form-control' . ($errors->has('account_no') ? ' is-invalid' : null)]) !!}
    @error('account_no')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('account_name', 'account_name') !!}
    {!! Form::text('account_name', null, ['placeholder' => 'account_name', 'class' => 'form-control' . ($errors->has('account_name') ? ' is-invalid' : null)]) !!}
    @error('account_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('bank_name', 'bank_name') !!}
    {!! Form::select('bank_name', config('constants.bankNames'), null, ['class' => 'form-control' . ($errors->has('bank_name') ? ' is-invalid' : null)]) !!}
    @error('bank_name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('branch_name', 'branch_name') !!}
    {!! Form::text('branch_name', null, ['placeholder' => 'branch_name', 'class' => 'form-control' . ($errors->has('branch_name') ? ' is-invalid' : null)]) !!}
    @error('branch_name')
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
    'label' => 'โลโก้ธนาคาร',
    'name' => 'bank_image',
    'key' => 'bankImage',
])
