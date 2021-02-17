<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Type') !!}
    {!! Form::select('type', $type, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Valid From') !!}
    {!! Form::date('valid_start', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('Valid To') !!}
    {!! Form::date('valid_end', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
</div>
