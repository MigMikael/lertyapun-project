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
<hr>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['placeholder' => 'Passowrd', 'class' => 'form-control']) !!}
</div>
<div class="form-group" style="margin-bottom: 3%">
    {!! Form::label('proof_image', 'Proof Image') !!} (ขั้นต่ำ 500 x 500px)
    {!! Form::file('proof_image', ['accept'=>'image/*', 'class' => 'form-control', 'value' => 'Choose a proof image']) !!}
</div>

